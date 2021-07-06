<?php 

namespace App\Filters;

use App\Filters\Filters;
use App\Models\User;

class ThreadFilters extends Filters
{
	protected $filters = ['by'];

	/**
	 * Filter the query by a given username
	 * 
	 * @param  string $username
	 * @return  mixed
	 */
	protected function by($username)
	{
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}