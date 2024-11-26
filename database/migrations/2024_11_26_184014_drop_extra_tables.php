<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('agreement_histories');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('core_pages');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('domains');
        Schema::dropIfExists('email_templates');
        Schema::dropIfExists('expense_types');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('features');
        Schema::dropIfExists('gateway_currencies');
        Schema::dropIfExists('gateways');
        Schema::dropIfExists('how_it_works');
        Schema::dropIfExists('invoice_items');
        Schema::dropIfExists('invoice_recurring_setting_items');
        Schema::dropIfExists('invoice_recurring_settings');
        Schema::dropIfExists('invoice_types');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('kyc_configs');
        Schema::dropIfExists('kyc_verifications');
        Schema::dropIfExists('listing_contacts');
        Schema::dropIfExists('listing_images');
        Schema::dropIfExists('listing_information');
        Schema::dropIfExists('listings');
        Schema::dropIfExists('mail_histories');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('notice_boards');
        Schema::dropIfExists('notice_user');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('property_units');
        Schema::dropIfExists('sms_histories');
        Schema::dropIfExists('subscription_orders');
        Schema::dropIfExists('tax_settings');
        Schema::dropIfExists('tenancies');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('ticket_replies');
        Schema::dropIfExists('ticket_topics');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('tenant_details');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('oauth_access_tokens');
        Schema::dropIfExists('oauth_auth_codes');
        Schema::dropIfExists('oauth_clients');
        Schema::dropIfExists('oauth_personal_access_clients');
        Schema::dropIfExists('oauth_refresh_tokens');
        Schema::dropIfExists('owner_packages');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
