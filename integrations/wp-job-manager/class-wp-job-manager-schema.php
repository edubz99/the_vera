<?php

class Capstone_WP_Job_Manager_Schema {

	public function __construct() {
        add_filter( 'wpjm_get_job_listing_structured_data', array( $this, 'salary_field_structured_data' ), 10, 2 );
    }

    #-------------------------------------------------------------------------------#
    #  Salary Field - Structured Data
    #-------------------------------------------------------------------------------#

    function salary_field_structured_data( $data, $post ){
        if( $post && $post->ID ){
            $salary = get_post_meta( $post->ID, '_job_salary', true );
            
            // Here you can add values that would be considered "not a salary" to skip output for
            $no_salary_values = array( 'Not Disclosed', 'N/A', 'TBD' );
            
            // Don't add anything if empty value, or value equals something above in no salary values
            if( empty( $salary) || in_array( strtolower( $salary ), array_map( 'strtolower' , $no_salary_values ) ) ){
                return $data;
            }
            
            // Determine float value, stripping all non-alphanumeric characters
            $salary_float_val = (float) filter_var( $salary, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
            
            if( ! empty( $salary_float_val ) ){
                // @see https://schema.org/JobPosting
                // Simple value:
                //$data['baseSalary'] = $salary_float_val;
                
                // Or using Google's Structured Data format
                // @see https://developers.google.com/search/docs/data-types/job-posting
                // This is the format Google really wants it in, so you should customize this yourself
                // to match your setup and configuration
                $data['baseSalary'] = array(
                    '@type' => 'MonetaryAmount',
                    'currency' => 'USD',
                    'value' => array(
                        '@type' => 'QuantitativeValue',
                        'value' => $salary_float_val,
                        // HOUR, DAY, WEEK, MONTH, or YEAR
                        'unitText' => 'YEAR'
                    )
                );
            }
        }
        return $data;
    }
    

}