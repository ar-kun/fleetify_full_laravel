<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $department_name
 * @property Carbon $max_clock_in_time
 * @property Carbon $max_clock_out_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Department extends Model
{
	use HasFactory;

	protected $table = 'departments';

	protected $casts = [
		'max_clock_in_time' => 'datetime',
		'max_clock_out_time' => 'datetime'
	];

	protected $fillable = [
		'department_name',
		'max_clock_in_time',
		'max_clock_out_time'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}
}