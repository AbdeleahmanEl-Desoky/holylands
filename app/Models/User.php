<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use SoftDeletes, HasRoles, HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'status',
        'image',
        'user_id',
        'birth_date',
        'place_of_birth',
        'nationality',
        'job',
        'affiliation_date',
        'address',
        'blood_type',
        'url_facebook',
        'lesson_count',
        'level_id',
        'fcm_token',
        'username',
        'coach_id',
        'note',
        'fcm_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getRoleIdAttribute()
    {
        return ($this->roles and (!empty($this->roles[0]))) ? $this->roles[0]->id : 0;
    }

    public function getImageAttribute($value)
    {
        return $value ? url('storage/' . $value) : url('dashboard/images/1.png');
    }

    static function statusList($status = "")
    {
        $array = [
            0 => __('Awaiting review'),
            1 => __('Acceptable'),
            2 => __('Disabled'),
        ];

        if ($status === false) {
            return $array;
        }

        if (!is_string($status) and $status != false or $status >= 0) {
            return !empty($array[$status]) ? $array[$status] : $status;
        }

        return $array;
    }

    static function gender($gender = "")
    {
        $array = [
            1 => __('Male'),
            2 => __('Female'),
        ];

        if ($gender == "") {
            return $array;
        } else {
            return !empty($array[$gender]) ? $array[$gender] : $gender;
        }
    }

    function level()
    {
        return $this->belongsTo(Level::class);
    }

    function lessons()
    {
        return $this->belongsToMany(Lesson::class, UserLesson::class);
    }

    function coach_users_lessons()
    {
        return $this->belongsToMany(Lesson::class, UserLesson::class , 'coach_id');
    }

    function coach_lessons()
    {
        return $this->hasMany(Lesson::class,'coach_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'coach_id');
    }

    public function user_horses()
    {
        return $this->hasMany(UserHorse::class);
    }

    public function notification($message = null, $title = null, $image = null, $type = null, $user_id = null, $coach_id = null, $lesson_id = null, $data = [])
    {
        $responses = [];
        if ($this->fcm_token) {
            $array = [];

            Notification::create([
                'title' => $title,
                'description' => $message,
                'type' => $type,
                'lesson_id' => $lesson_id,
                'user_id' => $user_id,
                'coach_id' => $coach_id,
            ]);

            $array['to'] = $this->fcm_token;

            if ($message) {
                $array['notification']['body'] = $message;
            }

            if ($title) {
                $array['notification']['title'] = $title;
            }

            if ($type) {
                $array['notification']['type'] = $type;
            }

            if ($lesson_id) {
                $array['notification']['lesson_id'] = $lesson_id;
            }

            if ($user_id) {
                $array['notification']['user_id'] = $user_id;
            }

            if ($coach_id) {
                $array['notification']['coach_id'] = $coach_id;
            }
            if ($image) {
                $array['notification']['image'] = $image;
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($array),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key=' . env('FIREBASE_SERVER_KEY'),
                    'Content-Type: application/json',
                    'to: '
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $responses[] = $response;

            return $responses;
        }
    }


}
