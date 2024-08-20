<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Role extends model
{
    //use HasRoles;
    protected $fillable = [
        'name',
    ];

    // protected $table = 'role_user';

    public static function createWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->post('name'),
            ]);
            foreach ($request->post('abilities') as $ability_code => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability_code,
                    'type' => $value,
                ]);
            }
            DB::commit();
        } catch
        (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $role;
    }

    public function updateWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->post('name'),
            ]);

            foreach ($request->post('abilities') as $ability_code => $value) {
                RoleAbility::updateOrCreate([
                    'role_id' => $this->id,
                    'ability' => $ability_code,
                ], [
                    'type' => $value,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this;
    }


    public function abilities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RoleAbility::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}


