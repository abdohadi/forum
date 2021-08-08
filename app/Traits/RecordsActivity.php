<?php 

namespace App\Traits;

trait RecordsActivity
{
	public static function bootRecordsActivity()
	{
		if (auth()->guest()) return;

		foreach (static::getActivitiesToRecord() as $event) {
	        static::created(function ($model) use ($event) {
	            $model->recordActivity($event);
	        });
		}
	}

	protected static function getActivitiesToRecord()
	{
		return ['created'];
	}

    public function recordActivity($event)
    {
        $this->activities()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
            'subject_id' => $this->id,
            'subject_type' => get_class($this)
        ]);
    }

    public function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }
}