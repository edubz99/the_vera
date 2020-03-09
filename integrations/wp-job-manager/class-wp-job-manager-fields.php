<?php

class Capstone_WP_Job_Manager_Fields {

	public function __construct() {
        add_filter( 'submit_job_form_fields', array( $this, 'frontend_job_excerpt_field' ) );
        add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_job_excerpt_field' ) );
        add_filter( 'submit_job_form_fields', array( $this, 'frontend_job_salary_field' ) );
        add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_job_salary_field' ) );
        add_filter( 'submit_job_form_fields', array( $this, 'frontend_job_career_level_field' ) );
        add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_job_career_level_field' ) );
        add_filter( 'submit_job_form_fields', array( $this, 'frontend_job_experience_field' ) );
        add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_job_experience_field' ) );
        add_filter( 'submit_job_form_fields', array( $this, 'frontend_job_qualification_field' ) );
        add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_job_qualification_field' ) );
    }

    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Excerpt Field
    #-------------------------------------------------------------------------------#

    // add field in "front-end"
    function frontend_job_excerpt_field( $fields ) {
        $fields['job']['job_excerpt'] = array(
            'label'       => __( 'Excerpt', 'capstone' ),
            'type'        => 'textarea',
            'required'    => false,
            'description' => __( 'Define a short excerpt which will appear in job listing view.', 'capstone' ),
            'priority'    => 8
        );
        return $fields;
    }

    // add field in "back-end"
    function admin_job_excerpt_field( $fields ) {
        $fields['_job_excerpt'] = array(
          'label'       => __( 'Job Excerpt', 'capstone' ),
          'type'        => 'textarea',
          'placeholder' => __( 'Define a short excerpt which will appear in job listing view.', 'capstone' ),
        );
        return $fields;
    }


    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Salary Field
    #-------------------------------------------------------------------------------#

    // add field in "front-end"
    function frontend_job_salary_field( $fields ) {
        $fields['job']['job_salary'] = array(
            'label'       => __( 'Salary', 'capstone' ),
            'type'        => 'textarea',
            'required'    => false,
            'description' => __( 'Define job salary value which will appear in job listing view.', 'capstone' ),
            'priority'    => 8
        );
        return $fields;
    }

    // add field in "back-end"
    function  admin_job_salary_field( $fields ) {
        $fields['_job_salary'] = array(
          'label'       => __( 'Salary', 'capstone' ),
          'type'        => 'textarea',
          'placeholder' => __( 'Define job salary value which will appear in job listing view.', 'capstone' ),
        );
        return $fields;
    }


    // function frontend_job_salary_field( $fields ) {
    //     $fields['job']['job_salary'] = array(
    //         'label'       => __( 'Salary', 'capstone' ),
    //         'type'        => 'select',
    //         'required'    => false,
    //         'options'     => apply_filters( 'capstone_job_salary_options', array('Not Disclosed', 
    //         '£0 - £100pd'  => '£0 - £100pd' , '£100 - £200pd' => '£100 - £200pd', '£200 - £300pd' => '£200 - £300pd', '£300 - £400pd' => '£300 - £400pd', '£400 - £500pd' => '£400 - £500pd','£500 - £750pd' => '£500 - £750pd', '£750 - £1000pd' => '£750 - £1000pd', '£1000 - £1250pd' => '£1000 - £1250pd', '£1250 - £1500pd' => '£1250 - £1500pd', '£1500 - £1750pd' => '£1500 - £1750pd', '£1750 - £2000pd' => '£1750 - £2000pd','£10,000 - £20,000' => '£10,000 - £20,000', '£20,000 - £30,000' => '£20,000 - £30,000', '£30,000 - £40,000' => '£30,000 - £40,000', '£40,000 - £50,000' => '£40,000 - £50,000', '£50,000 - £60,000' => '£50,000 - £60,000', '£60,000 - £70,000' => '£60,000 - £70,000', '£70,000 - £80,000' => '£70,000 - £80,000', '£80,000 - £90,000' => '£80,000 - £90,000', '£90,000 - £100,000' => '£90,000 - £100,000', '£100000+' => '£100,000 - Higher') ),
    //         'priority'    => 7
    //     );
    //     return $fields;
    // }

    // // add field in "back-end"
    // function admin_job_salary_field( $fields ) {
    //     $fields['_job_salary'] = array(
    //       'label'       => __( 'Salary', 'capstone' ),
    //       'type'        => 'select',
    //       'options'     => apply_filters( 'capstone_job_salary_options', array('Not Disclosed', 
    //       '£0 - £100pd'  => '£0 - £100pd' , '£100 - £200pd' => '£100 - £200pd', '£200 - £300pd' => '£200 - £300pd', '£300 - £400pd' => '£300 - £400pd', '£400 - £500pd' => '£400 - £500pd','£500 - £750pd' => '£500 - £750pd', '£750 - £1000pd' => '£750 - £1000pd', '£1000 - £1250pd' => '£1000 - £1250pd', '£1250 - £1500pd' => '£1250 - £1500pd', '£1500 - £1750pd' => '£1500 - £1750pd', '£1750 - £2000pd' => '£1750 - £2000pd','£10,000 - £20,000' => '£10,000 - £20,000', '£20,000 - £30,000' => '£20,000 - £30,000', '£30,000 - £40,000' => '£30,000 - £40,000', '£40,000 - £50,000' => '£40,000 - £50,000', '£50,000 - £60,000' => '£50,000 - £60,000', '£60,000 - £70,000' => '£60,000 - £70,000', '£70,000 - £80,000' => '£70,000 - £80,000', '£80,000 - £90,000' => '£80,000 - £90,000', '£90,000 - £100,000' => '£90,000 - £100,000', '£100000+' => '£100,000 - Higher') ),
    //       'description' => ''
    //     );
    //     return $fields;
    // }


    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Career Level Field
    #-------------------------------------------------------------------------------#

    // add field in "front-end"
    function frontend_job_career_level_field( $fields ) {
        $fields['job']['job_career_level'] = array(
            'label'       => __( 'Career Level', 'capstone' ),
            'type'        => 'select',
            'required'    => false,
            'options'     => apply_filters( 'capstone_job_career_level_options', array('',  'Account Manager' => 'Account Manager', 'Administrator' => 'Administrator', 'Analyst' => 'Analyst', 'Assistant' => 'Assistant', 'Architect' => 'Architect', 'Business Development Manager' => 'Business Development Manager', 'Designer' => 'Designer', 'Director' => 'Director', 'Engineer' => 'Engineer', 'Entry Level' => 'Entry Level', 'Executive' => 'Executive', 'Graduate' => 'Graduate', 'Intern' => 'Intern', 'Internal Sales' => 'Internal Sales', 'Manager' => 'Manager', 'Mid-Level' => 'Mid-Level','Mid-Manager' => 'Mid-Manager', 'Marketing' => 'Marketing', 'Operations' => 'Operations', 'Sales' => 'Sales','Supervisor' => 'Supervisor', 'Seasoned Professional' => 'Seasoned Professional', 'Senior Manager' => 'Senior Manager', 'Senior Sales' => 'Senior Sales', 'Team Leader' => 'Team Leader', 'Technician' => 'Technician', 'Tester' => 'Tester', 'Warehousing' => 'Warehousing') ),
            'priority'    => 7
        );
        return $fields;
    }

    // add field in "back-end"
    function admin_job_career_level_field( $fields ) {
        $fields['_job_career_level'] = array(
          'label'       => __( 'Career Level', 'capstone' ),
          'type'        => 'select',
          'options'     =>  apply_filters( 'capstone_job_career_level_options', array('',  'Account Manager' => 'Account Manager', 'Administrator' => 'Administrator', 'Analyst' => 'Analyst', 'Assistant' => 'Assistant', 'Architect' => 'Architect', 'Business Development Manager' => 'Business Development Manager', 'Designer' => 'Designer', 'Director' => 'Director', 'Engineer' => 'Engineer', 'Entry Level' => 'Entry Level', 'Executive' => 'Executive', 'Graduate' => 'Graduate', 'Intern' => 'Intern', 'Internal Sales' => 'Internal Sales', 'Manager' => 'Manager', 'Mid-Level' => 'Mid-Level','Mid-Manager' => 'Mid-Manager', 'Marketing' => 'Marketing', 'Operations' => 'Operations', 'Sales' => 'Sales','Supervisor' => 'Supervisor', 'Seasoned Professional' => 'Seasoned Professional', 'Senior Manager' => 'Senior Manager', 'Senior Sales' => 'Senior Sales', 'Team Leader' => 'Team Leader', 'Technician' => 'Technician', 'Tester' => 'Tester', 'Warehousing' => 'Warehousing') ),
          'description' => ''
        );
        return $fields;
    }


    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Experience Field
    #-------------------------------------------------------------------------------#

    // add field in "front-end"
    function frontend_job_experience_field( $fields ) {
        $fields['job']['job_experience'] = array(
            'label'       => __( 'Experience', 'capstone' ),
            'type'        => 'select',
            'required'    => false,
            'options'     => apply_filters( 'capstone_job_experience_options', array('No Experience', '1 - 2 Years' => '1 - 2 Years', '2 - 3 Years' => '2 - 3 Years', '3 - 5 Years' => '3 - 5 Years', '5 - 6 Years' => '5 - 6 Years', '6 - 7 Years' => '6 - 7 Years', '7 - 8 Years' => '7 - 8 Years', '8 - 9 Years' => '8 - 9 Years', '9-10 Years' => '9-10 Years') ),
            'priority'    => 7
        );
        return $fields;
    }

    // add field in "back-end"
    function admin_job_experience_field( $fields ) {
        $fields['_job_experience'] = array(
          'label'       => __( 'Experience', 'capstone' ),
          'type'        => 'select',
          'options'     => apply_filters( 'capstone_job_experience_options', array('No Experience', '1 - 2 Years' => '1 - 2 Years', '2 - 3 Years' => '2 - 3 Years', '3 - 5 Years' => '3 - 5 Years', '5 - 6 Years' => '5 - 6 Years', '6 - 7 Years' => '6 - 7 Years', '7 - 8 Years' => '7 - 8 Years', '8 - 9 Years' => '8 - 9 Years', '9-10 Years' => '9-10 Years') ),
          'description' => ''
        );
        return $fields;
    }


    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Qualification Field
    #-------------------------------------------------------------------------------#

    // add field in "front-end"
    function frontend_job_qualification_field( $fields ) {
        $fields['job']['job_qualification'] = array(
            'label'       => __( 'Qualification', 'capstone' ),
            'type'        => 'select',
            'required'    => false,
            'options'     => apply_filters( 'capstone_job_qualification_options', array('No Qualification',  'PhD' => 'PhD', 'Masters Degree or Higher' => 'Masters Degree or Higher', 'University Degree' => 'University Degree','Senior Business or Technical Qualification' => 'Senior Business or Technical Qualification', 'HND / HNC' => 'HND / HNC', 'Diploma' => 'Diploma', 'BTEC' => 'BTEC', 'City & Guilds' => 'City & Guilds', 'A-Levels / Advanced GNVQ' => 'A-Levels / Advanced GNVQ', 'GCSE / GNVQ / O-Levels' => 'GCSE / GNVQ / O-Levels') ),
            'priority'    => 7
        );
        return $fields;
    }

    // add field in "back-end"
    function admin_job_qualification_field( $fields ) {
        $fields['_job_qualification'] = array(
          'label'       => __( 'Qualification', 'capstone' ),
          'type'        => 'select',
          'options'     => apply_filters( 'capstone_job_qualification_options', array('No Qualification', 'PhD' => 'PhD', 'Masters Degree or Higher' => 'Masters Degree or Higher', 'University Degree' => 'University Degree','Senior Business or Technical Qualification' => 'Senior Business or Technical Qualification', 'HND / HNC' => 'HND / HNC', 'Diploma' => 'Diploma', 'BTEC' => 'BTEC', 'City & Guilds' => 'City & Guilds', 'A-Levels / Advanced GNVQ' => 'A-Levels / Advanced GNVQ', 'GCSE / GNVQ / O-Levels' => 'GCSE / GNVQ / O-Levels') ),
          'description' => ''
        );
        return $fields;
    }

    #-------------------------------------------------------------------------------#
    #  WP Job Manager - Configure Options Filters
    #-------------------------------------------------------------------------------#

    // Salary - Options
    // function salary_args( $args ) {
    //     $args = array('', '$10,000 - $20,000' => '$10,000 - $20,000');
    //     return $args;
    // }
    // add_filter( 'capstone_job_salary_options', 'capstone_salary_args' );

}

$GLOBALS['job_manager_fields'] = new Capstone_WP_Job_Manager_Fields();