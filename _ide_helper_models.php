<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $content
 * @property int $type
 * @property string $phone
 * @property string $project
 * @property string $reason
 * @property string|null $time_start
 * @property string|null $time_end
 * @property int $status
 * @property string|null $dealine
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereDealine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUserId($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Time_keep
 *
 * @property int $id
 * @property string $time_in
 * @property string $time_out
 * @property string $day
 * @property int|null $user_id
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep query()
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep whereTimeIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep whereTimeOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time_keep whereUserId($value)
 */
	class Time_keep extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $department
 * @property string|null $position
 * @property string $email
 * @property string $password
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $age
 * @property string|null $project
 * @property string|null $sex
 * @property string|null $permanent_address
 * @property string|null $seniority
 * @property string|null $working_day
 * @property string|null $promotion_day
 * @property string|null $contract
 * @property string|null $temporary_address
 * @property string|null $cccd
 * @property string|null $date_range
 * @property string|null $issued_by
 * @property string|null $personal_email
 * @property string|null $tax_code
 * @property string|null $leave_days
 * @property string|null $use_property
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read int|null $contacts_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Time_keep> $timeKeep
 * @property-read int|null $time_keep_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCccd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIssuedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLeaveDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePermanentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePersonalEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePromotionDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSeniority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTaxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTemporaryAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUseProperty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWorkingDay($value)
 */
	class User extends \Eloquent {}
}

