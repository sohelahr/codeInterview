<?php

namespace App\Jobs;

use App\Models\PinCode;
use App\Models\ImportSummary;

class ProcessCsvJob extends Job
{

    public $import_summary_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($import_summary_id)
    {
        $this->import_summary_id = $import_summary_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('max_execution_time', 13000); //300 seconds = 5 minutes
        $response = fopen("http://data.gov.in/sites/default/files/all_india_pin_code.csv", "r");
        $headerRow = true;
        $pincode_arr = [];
        $row = 0;
        while (($data = fgetcsv($response, 4000, ",")) !== FALSE) {
            if (!$headerRow) {
                //Checking for duplicate data
                $check_duplicate = array_search($data['1'], array_column($pincode_arr, 'pin_code'));
                if(!$check_duplicate) {
                    $pincode_arr[$row]['office_name'] = str_replace("©","",$data['0']);
                    $pincode_arr[$row]['pin_code'] = $data['1'];
                    $pincode_arr[$row]['office_type'] = $data['2'];
                    $pincode_arr[$row]['delivery_status'] = $data['3'];
                    $pincode_arr[$row]['division_name'] = $data['4'];
                    $pincode_arr[$row]['region_name'] = $data['5'];
                    $pincode_arr[$row]['circle_name'] = $data['6'];
                    $pincode_arr[$row]['taluk'] = $data['7'];
                    $pincode_arr[$row]['district_name'] = $data['8'];
                    $pincode_arr[$row]['state_name'] = $data['9'];
                    $row++;
                }
            }
            $headerRow = false;
        }

        if(count($arr) > 0) {

            //Removing specific element from array
            $key = array_search('370240', array_column($pincode_arr, 'pin_code'));
            if($key) {
                unset($pincode_arr[$key]);
            }

            //Creating small chunks
            $pincode_arr_chunks = array_chunk($pincode_arr,1000);
            foreach ($pincode_arr_chunks as $pincode_arr_chunk) {
                PinCode::insert($pincode_arr_chunk);
            }
        }

        //Once import is completed updating import summary
        ImportSummary::find($this->import_summary_id)->update(['import_status' => '1']);
    }
}
