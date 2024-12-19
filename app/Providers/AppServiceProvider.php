<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::define('view_payment', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_payment') {
                    return true;
                }
            }
        });


        Gate::define('view_order', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_order') {
                    return true;
                }
            }
        });

        Gate::define('accept_order', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'accept_order') {
                    return true;
                }
            }
        });

        Gate::define('reject_order', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'reject_order') {
                    return true;
                }
            }
        });

        Gate::define('complete_order', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'complete_order') {
                    return true;
                }
            }
        });


        Gate::define('payment_received', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'payment_received') {
                    return true;
                }
            }
        });



        Gate::define('view_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_user') {
                    return true;
                }
            }
        });

        Gate::define('add_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_admin') {
                    return true;
                }
            }
        });

        Gate::define('edit_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_admin') {
                    return true;
                }
            }
        });

        Gate::define('delete_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_admin') {
                    return true;
                }
            }
        });


        Gate::define('view_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_admin') {
                    return true;
                }
            }
        });

        Gate::define('view_mobile_page', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_mobile_page') {
                    return true;
                }
            }
        });


        Gate::define('restore_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_user') {
                    return true;
                }
            }
        });

        Gate::define('restore_admin', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_admin') {
                    return true;
                }
            }
        });

        Gate::define('restore_roles', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'restore_roles') {
                    return true;
                }
            }
        });
        
        Gate::define('view_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_role') {
                    return true;
                }
            }
        });

        Gate::define('add_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_role') {
                    return true;
                }
            }
        });

        Gate::define('edit_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_role') {
                    return true;
                }
            }
        });

        Gate::define('delete_role', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_role') {
                    return true;
                }
            }
        });

        Gate::define('delete_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_category') {
                    return true;
                }
            }
        });

        Gate::define('view_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_category') {
                    return true;
                }
            }
        });

        Gate::define('add_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_category') {
                    return true;
                }
            }
        });

        Gate::define('edit_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_category') {
                    return true;
                }
            }
        });



        Gate::define('delete_coupon', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_coupon') {
                    return true;
                }
            }
        });

        Gate::define('view_coupon', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_coupon') {
                    return true;
                }
            }
        });

        Gate::define('add_coupon', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_coupon') {
                    return true;
                }
            }
        });

        Gate::define('edit_coupon', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_coupon') {
                    return true;
                }
            }
        });


        Gate::define('delete_attribute', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_attribute') {
                    return true;
                }
            }
        });

        Gate::define('view_attribute', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_attribute') {
                    return true;
                }
            }
        });

        Gate::define('add_attribute', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_attribute') {
                    return true;
                }
            }
        });

        Gate::define('edit_attribute', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_attribute') {
                    return true;
                }
            }
        });




        Gate::define('delete_our_client', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_our_client') {
                    return true;
                }
            }
        });

        Gate::define('view_our_client', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_our_client') {
                    return true;
                }
            }
        });

        Gate::define('add_our_client', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_our_client') {
                    return true;
                }
            }
        });

        Gate::define('edit_our_client', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_our_client') {
                    return true;
                }
            }
        });


        Gate::define('delete_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_contact_us') {
                    return true;
                }
            }
        });

        Gate::define('view_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_contact_us') {
                    return true;
                }
            }
        });

        Gate::define('reply_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'reply_contact_us') {
                    return true;
                }
            }
        });



        Gate::define('delete_sub_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_sub_category') {
                    return true;
                }
            }
        });

        Gate::define('view_sub_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_sub_category') {
                    return true;
                }
            }
        });

        Gate::define('add_sub_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_sub_category') {
                    return true;
                }
            }
        });

        Gate::define('edit_sub_category', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_sub_category') {
                    return true;
                }
            }
        });


        Gate::define('delete_product', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_product') {
                    return true;
                }
            }
        });

        Gate::define('view_product', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_product') {
                    return true;
                }
            }
        });

        Gate::define('add_product', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_product') {
                    return true;
                }
            }
        });

        Gate::define('edit_product', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_product') {
                    return true;
                }
            }
        });

        Gate::define('edit_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_user') {
                    return true;
                }
            }
        });

        Gate::define('delete_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_user') {
                    return true;
                }
            }
        });

        Gate::define('block_unblock_user', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;

            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'block_unblock_user') {
                    return true;
                }
            }
        });


        Gate::define('add_permissions', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'add_permissions') {
                    return true;
                }
            }
        });


        Gate::define('delete_user_permanent', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_user_permanent') {
                    return true;
                }
            }
        });

        Gate::define('delete_admin_permanent', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'delete_admin_permanent') {
                    return true;
                }
            }
        });



        //Recycle bin role
        Gate::define('permanent_delete_roles', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'permanent_delete_roles') {
                    return true;
                }
            }
        });
       

        Gate::define('view_configuration', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_configuration') {
                    return true;
                }
            }
        });


        Gate::define('edit_configuration', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'edit_configuration') {
                    return true;
                }
            }
        });

       

        Gate::define('view_contact_us', function ($user) {
            $user = Auth::user();
            $permissions = $user->role->permissions;
            for ($i=0; $i < count($permissions); $i++) { 
                if($permissions[$i]->slug == 'view_contact_us') {
                    return true;
                }
            }
        });
    }
}
