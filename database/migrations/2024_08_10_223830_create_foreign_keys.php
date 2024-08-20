<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('governorate_id')->references('id')->on('governorates')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('posts', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->foreign('donation_request_id')->references('id')->on('donation_requests')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clientables', function(Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
      //  Schema::table('tokens', function(Blueprint $table) {
      //          $table->foreign('client_id')->references('id')->on('clients')
      //              ->onDelete('no action')
      //              ->onUpdate('no action');
	//	});
		Schema::table('clientables', function(Blueprint $table) {
			$table->foreign('clientable_id')->references('id')->on('clients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
        Schema::table('role_abilities', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('role_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
	}

	public function down()
	{
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_governorate_id_foreign');
		});
		Schema::table('posts', function(Blueprint $table) {
			$table->dropForeign('posts_category_id_foreign');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->dropForeign('donation_requests_city_id_foreign');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->dropForeign('donation_requests_blood_type_id_foreign');
		});
		Schema::table('donation_requests', function(Blueprint $table) {
			$table->dropForeign('donation_requests_client_id_foreign');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_donation_request_id_foreign');
		});
		Schema::table('clientables', function(Blueprint $table) {
			$table->dropForeign('clientables_client_id_foreign');
		});
 //       Schema::table('tokens', function(Blueprint $table) {
  //          $table->dropForeign('tokens_client_id_foreign');
   //     });
		Schema::table('clientables', function(Blueprint $table) {
			$table->dropForeign('clientables_clientable_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_blood_type_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_city_id_foreign');
		});
        Schema::table('role_abilities', function(Blueprint $table) {
            $table->dropForeign('role_abilities_role_id_foreign');
        });
        Schema::table('role_user', function(Blueprint $table) {
            $table->dropForeign('role_user_role_id_foreign');
        });
        Schema::table('role_user', function(Blueprint $table) {
            $table->dropForeign('role_user_user_id_foreign');
        });


	}
}
