<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sortname');
            $table->string('country');
            $table->string('phonecode');
            $table->timestamps();
        });

        # Set default timezone
        date_default_timezone_set('Africa/Lagos');

        # create default data
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [1, 'AF', 'Afghanistan', +93, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [2, 'AL', 'Albania', +355, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [3, 'DZ', 'Algeria', +213, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [4, 'AS', 'American Samoa', +1684, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [5, 'AD', 'Andorra', +376, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [6, 'AO', 'Angola', +244, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [7, 'AI', 'Anguilla', +1264, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [8, 'AQ', 'Antarctica', +672, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [9, 'AG', 'Antigua And Barbuda', +1268, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [10, 'AR', 'Argentina', +54, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [11, 'AM', 'Armenia', +374, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [12, 'AW', 'Aruba', +297, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [13, 'AU', 'Australia', +61, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [14, 'AT', 'Austria', +43, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [15, 'AZ', 'Azerbaijan', +994, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [16, 'BS', 'Bahamas The', +1242, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [17, 'BH', 'Bahrain', +973, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [18, 'BD', 'Bangladesh', +880, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [19, 'BB', 'Barbados', +1246, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [20, 'BY', 'Belarus', +375, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [21, 'BE', 'Belgium', +32, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [22, 'BZ', 'Belize', +501, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [23, 'BJ', 'Benin', +229, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [24, 'BM', 'Bermuda', +1441, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [25, 'BT', 'Bhutan', +975, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [26, 'BO', 'Bolivia', +591, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [27, 'BA', 'Bosnia and Herzegovina', +387, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [28, 'BW', 'Botswana', +267, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [29, 'BV', 'Bouvet Island', +55, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [30, 'BR', 'Brazil', +55, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [31, 'IO', 'British Indian Ocean Territory', +246, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [32, 'BN', 'Brunei', +673, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [33, 'BG', 'Bulgaria', +359, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [34, 'BF', 'Burkina Faso', +226, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [35, 'BI', 'Burundi', +257, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [36, 'KH', 'Cambodia', +855, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [37, 'CM', 'Cameroon', +237, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [38, 'CA', 'Canada', +1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [39, 'CV', 'Cape Verde', +238, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [40, 'KY', 'Cayman Islands', +1345, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [41, 'CF', 'Central African Republic', +236, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [42, 'TD', 'Chad', +235, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [43, 'CL', 'Chile', +56, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [44, 'CN', 'China', +86, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [45, 'CX', 'Christmas Island', +61, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [46, 'CC', 'Cocos (Keeling) Islands', +672, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [47, 'CO', 'Colombia', +57, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [48, 'KM', 'Comoros', +269, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [49, 'CG', 'Republic Of The Congo', +242, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [50, 'CD', 'Democratic Republic Of The Congo', +242, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [51, 'CK', 'Cook Islands', +682, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [52, 'CR', 'Costa Rica', +506, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [53, 'CI', 'Cote D\' Ivoire (Ivory Coast)', +225, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [54, 'HR', 'Croatia (Hrvatska)', +385, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [55, 'CU', 'Cuba', +53, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [56, 'CY', 'Cyprus', +357, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [57, 'CZ', 'Czech Republic', +420, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [58, 'DK', 'Denmark', +45, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [59, 'DJ', 'Djibouti', +253, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [60, 'DM', 'Dominica', +1767, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [61, 'DO', 'Dominican Republic', +1809, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [62, 'TP', 'East Timor', +670, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [63, 'EC', 'Ecuador', +593, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [64, 'EG', 'Egypt', +20, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [65, 'SV', 'El Salvador', +503, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [66, 'GQ', 'Equatorial Guinea', +240, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [67, 'ER', 'Eritrea', +291, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [68, 'EE', 'Estonia', +372, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [69, 'ET', 'Ethiopia', +251, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [70, 'XA', 'External Territories of Australia', +61, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [71, 'FK', 'Falkland Islands', +500, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [72, 'FO', 'Faroe Islands', +298, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [73, 'FJ', 'Fiji Islands', +679, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [74, 'FI', 'Finland', +358, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [75, 'FR', 'France', +33, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [76, 'GF', 'French Guiana', +594, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [77, 'PF', 'French Polynesia', +689, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [78, 'TF', 'French Southern Territories', +262, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [79, 'GA', 'Gabon', +241, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [80, 'GM', 'Gambia The', +220, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [81, 'GE', 'Georgia', +995, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [82, 'DE', 'Germany', +49, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [83, 'GH', 'Ghana', +233, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [84, 'GI', 'Gibraltar', +350, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [85, 'GR', 'Greece', +30, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [86, 'GL', 'Greenland', +299, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [87, 'GD', 'Grenada', +1473, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [88, 'GP', 'Guadeloupe', +590, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [89, 'GU', 'Guam', +1671, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [90, 'GT', 'Guatemala', +502, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [91, 'XU', 'Guernsey and Alderney', +44, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [92, 'GN', 'Guinea', +224, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [93, 'GW', 'Guinea-Bissau', +245, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [94, 'GY', 'Guyana', +592, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [95, 'HT', 'Haiti', +509, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [96, 'HM', 'Heard and McDonald Islands', +672, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [97, 'HN', 'Honduras', +504, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [98, 'HK', 'Hong Kong S.A.R.', +852, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [99, 'HU', 'Hungary', +36, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [100, 'IS', 'Iceland', +354, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [101, 'IN', 'India', +91, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [102, 'ID', 'Indonesia', +62, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [103, 'IR', 'Iran', +98, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [104, 'IQ', 'Iraq', +964, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [105, 'IE', 'Ireland', +353, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [106, 'IL', 'Israel', +972, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [107, 'IT', 'Italy', +39, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [108, 'JM', 'Jamaica', +1876, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [109, 'JP', 'Japan', +81, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [110, 'XJ', 'Jersey', +44, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [111, 'JO', 'Jordan', +962, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [112, 'KZ', 'Kazakhstan', +7, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [113, 'KE', 'Kenya', +254, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [114, 'KI', 'Kiribati', +686, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [115, 'KP', 'Korea North', +850, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [116, 'KR', 'Korea South', +82, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [117, 'KW', 'Kuwait', +965, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [118, 'KG', 'Kyrgyzstan', +996, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [119, 'LA', 'Laos', +856, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [120, 'LV', 'Latvia', +371, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [121, 'LB', 'Lebanon', +961, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [122, 'LS', 'Lesotho', +266, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [123, 'LR', 'Liberia', +231, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [124, 'LY', 'Libya', +218, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [125, 'LI', 'Liechtenstein', +423, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [126, 'LT', 'Lithuania', +370, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [127, 'LU', 'Luxembourg', +352, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [128, 'MO', 'Macau S.A.R.', +853, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [129, 'MK', 'Macedonia', +389, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [130, 'MG', 'Madagascar', +261, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [131, 'MW', 'Malawi', +265, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [132, 'MY', 'Malaysia', +60, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [133, 'MV', 'Maldives', +960, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [134, 'ML', 'Mali', +223, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [135, 'MT', 'Malta', +356, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [136, 'XM', 'Man (Isle of)', +44, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [137, 'MH', 'Marshall Islands', +692, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [138, 'MQ', 'Martinique', +596, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [139, 'MR', 'Mauritania', +222, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [140, 'MU', 'Mauritius', +230, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [141, 'YT', 'Mayotte', +269, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [142, 'MX', 'Mexico', +52, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [143, 'FM', 'Micronesia', +691, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [144, 'MD', 'Moldova', +373, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [145, 'MC', 'Monaco', +377, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [146, 'MN', 'Mongolia', +976, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [147, 'MS', 'Montserrat', +1664, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [148, 'MA', 'Morocco', +212, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [149, 'MZ', 'Mozambique', +258, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [150, 'MM', 'Myanmar', +95, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [151, 'NA', 'Namibia', +264, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [152, 'NR', 'Nauru', +674, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [153, 'NP', 'Nepal', +977, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [154, 'AN', 'Netherlands Antilles', +599, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [155, 'NL', 'Netherlands', +31, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [156, 'NC', 'New Caledonia', +687, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [157, 'NZ', 'New Zealand', +64, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [158, 'NI', 'Nicaragua', +505, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [159, 'NE', 'Niger', +227, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [160, 'NG', 'Nigeria', +234, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [161, 'NU', 'Niue', +683, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [162, 'NF', 'Norfolk Island', +672, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [163, 'MP', 'Northern Mariana Islands', +1670, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [164, 'NO', 'Norway', +47, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [165, 'OM', 'Oman', +968, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [166, 'PK', 'Pakistan', +92, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [167, 'PW', 'Palau', +680, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [168, 'PS', 'Palestinian Territory Occupied', +970, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [169, 'PA', 'Panama', +507, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [170, 'PG', 'Papua new Guinea', +675, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [171, 'PY', 'Paraguay', +595, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [172, 'PE', 'Peru', +51, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [173, 'PH', 'Philippines', +63, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [174, 'PN', 'Pitcairn Island', +64, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [175, 'PL', 'Poland', +48, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [176, 'PT', 'Portugal', +351, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [177, 'PR', 'Puerto Rico', +1787, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [178, 'QA', 'Qatar', +974, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [179, 'RE', 'Reunion', +262, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [180, 'RO', 'Romania', +40, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [181, 'RU', 'Russia', +70, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [182, 'RW', 'Rwanda', +250, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [183, 'SH', 'Saint Helena', +290, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [184, 'KN', 'Saint Kitts And Nevis', +1869, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [185, 'LC', 'Saint Lucia', +1758, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [186, 'PM', 'Saint Pierre and Miquelon', +508, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [187, 'VC', 'Saint Vincent And The Grenadines', +1784, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [188, 'WS', 'Samoa', +684, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [189, 'SM', 'San Marino', +378, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [190, 'ST', 'Sao Tome and Principe', +239, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [191, 'SA', 'Saudi Arabia', +966, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [192, 'SN', 'Senegal', +221, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [193, 'RS', 'Serbia', +381, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [194, 'SC', 'Seychelles', +248, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [195, 'SL', 'Sierra Leone', +232, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [196, 'SG', 'Singapore', +65, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [197, 'SK', 'Slovakia', +421, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [198, 'SI', 'Slovenia', +386, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [199, 'XG', 'Smaller Territories of the UK', +44, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [200, 'SB', 'Solomon Islands', +677, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [201, 'SO', 'Somalia', +252, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [202, 'ZA', 'South Africa', +27, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [203, 'GS', 'South Georgia', +500, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [204, 'SS', 'South Sudan', +211, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [205, 'ES', 'Spain', +34, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [206, 'LK', 'Sri Lanka', +94, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [207, 'SD', 'Sudan', +249, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [208, 'SR', 'Suriname', +597, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [209, 'SJ', 'Svalbard And Jan Mayen Islands', +47, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [210, 'SZ', 'Swaziland', +268, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [211, 'SE', 'Sweden', +46, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [212, 'CH', 'Switzerland', +41, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [213, 'SY', 'Syria', +963, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [214, 'TW', 'Taiwan', +886, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [215, 'TJ', 'Tajikistan', +992, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [216, 'TZ', 'Tanzania', +255, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [217, 'TH', 'Thailand', +66, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [218, 'TG', 'Togo', +228, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [219, 'TK', 'Tokelau', +690, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [220, 'TO', 'Tonga', +676, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [221, 'TT', 'Trinidad And Tobago', +1868, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [222, 'TN', 'Tunisia', +216, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [223, 'TR', 'Turkey', +90, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [224, 'TM', 'Turkmenistan', +7370, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [225, 'TC', 'Turks And Caicos Islands', +1649, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [226, 'TV', 'Tuvalu', +688, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [227, 'UG', 'Uganda', +256, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [228, 'UA', 'Ukraine', +380, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [229, 'AE', 'United Arab Emirates', +971, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [230, 'GB', 'United Kingdom', +44, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [231, 'US', 'United States', +1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [232, 'UM', 'United States Minor Outlying Islands', +1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [233, 'UY', 'Uruguay', +598, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [234, 'UZ', 'Uzbekistan', +998, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [235, 'VU', 'Vanuatu', +678, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [236, 'VA', 'Vatican City State (Holy See)', +39, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [237, 'VE', 'Venezuela', +58, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [238, 'VN', 'Vietnam', +84, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [239, 'VG', 'Virgin Islands (British)', +1284, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [240, 'VI', 'Virgin Islands (US)', +1340, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [241, 'WF', 'Wallis And Futuna Islands', +681, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [242, 'EH', 'Western Sahara', +212, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [243, 'YE', 'Yemen', +967, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [244, 'YU', 'Yugoslavia', +38, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [245, 'ZM', 'Zambia', +260, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
        DB::insert('INSERT INTO countries (id, sortname, country, phonecode, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [246, 'ZW', 'Zimbabwe', +263, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
