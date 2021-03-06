<?php
namespace App;

trait RecordsActivity
{
    public $oldAttributes = [];

    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function($model) use ($event){
                $model->recordActivity($model->activityDescription($event));

            });

            if($event === 'updated'){
                static::updating(function($model){
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    protected static function recordableEvents()
    {
        //if the user has created a property on their model...
        if(isset(static::$recordableEvents)){
            //use the recordableEvents as set on the model
            return static::$recordableEvents;
        }
        //otherwise use the defaults
        return ['created', 'updated'];
    }

    /**
     * The activity feed for the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes' =>  $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id
        ]);
    }

    public function activityChanges()
    {
        if ($this->wasChanged()){
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                // 'after' => array_diff($this->getAttributes(), $this->oldAttributes),
                'after' => array_except($this->getChanges(), 'updated_at'),
            ];
        }
    }
}
