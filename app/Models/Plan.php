<?php

namespace App\Models;

use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function search($filter = null)
    {
        $results = $this->where('name',  'LIKE', "%{$filter}%")
            ->orWhere('description',  'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

      /**
     * Profiles not linked with this plan
     */
    public function profilesAvailable($filter = null)
    {
        $this->id;
        $profiles = Profile::whereNotIn('profiles.id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if($filter){
                $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();

        return $profiles;
    }
}
