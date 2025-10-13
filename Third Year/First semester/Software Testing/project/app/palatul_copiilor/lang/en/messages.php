<?php

return [
// index.php

    'welcome' => 'Welcome to the Children\'s Palace in Cluj-Napoca',
    'intro' => 'To better monitor the activities of the Children\'s Palace in Cluj-Napoca, we have created a database that facilitates the management of activities and services offered to children.',
    'details_1' => 'Our institution happily welcomes children aged between <strong>3 and 18 years</strong>, offering them opportunities to participate in various educational and recreational courses and activities.',
    'details_2' => 'Grouping children by age categories is essential for setting rates and personalizing activities. Children can choose between two session packages: one with <strong>14 sessions</strong> and another with <strong>28 sessions</strong>, each session lasting <strong>2 hours</strong>.',
    'details_3' => 'Our fields of interest include <strong>music, sports, and drawing</strong>, and for each activity, we have dedicated teachers who ensure the highest quality experience. Participation in courses is based on scheduling, and payments can be made in cash or by card.',
    'details_4' => 'This project includes a well-structured, normalized, and optimized database to manage all these aspects. The database structure reflects the complex relationships between the main entities: participants, appointments, age groups, rates, staff, payments, and activities.',



// register.php

    'register_title' => 'Register',
    'error_message' => 'An error occurred while creating the account.',
    'success_message' => 'The account was successfully created!',
    'username_label' => 'Username:',
    'password_label' => 'Password:',
    'email_label' => 'Email:',
    'role_label' => 'Role:',
    'role_placeholder' => 'Select a role',
    'role_professor' => 'Professor',
    'role_student' => 'Student',
    'submit_button' => 'Register',



// programari_elevi.php

    'appointments_title' => 'Your Appointments',
    'table_date' => 'Data',
    'table_start_time' => 'Start Time',
    'table_end_time' => 'End Time',
    'table_activity' => 'Activity',
    'add_appointment_button' => 'Add Appointment',



// programari.php

    'appointments_title' => 'All Appointments',
    'table_user' => 'User',
    'table_date' => 'Date',
    'table_start_time' => 'Start Time',
    'table_end_time' => 'End Time',
    'table_activity' => 'Activity',



// profil_utilizator.php

    'profile_title' => 'My Profile',
    'error_message' => 'An error occurred while updating the profile.',
    'success_message' => 'Profile updated successfully!',
    'username_label' => 'Username',
    'email_label' => 'Email',
    'password_label' => 'New Password (leave blank if you do not wish to change it)',
    'avatar_label' => 'Avatar',
    'avatar_upload_error' => 'Error uploading file.',
    'avatar_invalid_type' => 'File type not accepted. Use JPG, PNG, or GIF.',
    'avatar_update_success' => 'Avatar updated successfully!',
    'all_fields_required' => 'All fields are required except for the password.',
    'update_button' => 'Update Profile',


// plati.php

    'payments_title' => 'Payment List',
    'filter_label' => 'Filter by type:',
    'filter_all' => 'All',
    'filter_card' => 'Card',
    'filter_cash' => 'Cash',
    'filter_button' => 'Filter',
    'reset_button' => 'Reset',
    'table_number' => 'Number',
    'table_payment_date' => 'Payment Date',
    'table_amount' => 'Amount',
    'table_bank' => 'Bank',
    'table_payment_type' => 'Payment Type',
    'no_results' => 'No payments found for the selected filter.',
    'currency' => 'RON',



// participanti.php

    'participants_title' => 'Participants List',
    'search_name_label' => 'Search by name/surname:',
    'search_group_label' => 'Filter by group:',
    'search_button' => 'Search',
    'reset_button' => 'Reset',
    'add_participant_button' => 'Add Participant',
    'table_code' => 'Code',
    'table_name' => 'Name',
    'table_surname' => 'Surname',
    'table_birth_date' => 'Birth Date',
    'table_address' => 'Address',
    'table_phone' => 'Phone Number',
    'table_group' => 'Group',
    'table_actions' => 'Actions',
    'edit_button' => 'Edit',
    'delete_button' => 'Delete',
    'delete_confirmation' => 'Are you sure you want to delete this participant?',
    'no_results' => 'No participants found.',



// logout.php

    'logout_message' => 'You have successfully logged out.',
    'redirect_message' => 'You will be redirected to the login page.',



// login.php

    'login_title' => 'Login',
    'login_error' => 'Invalid username or password!',
    'username_label' => 'Username',
    'password_label' => 'Password',
    'login_button' => 'Login',
    'no_account_text' => 'Don’t have an account?',
    'register_link_text' => 'Register',



// lista_utilizatori.php

    'users_list_title' => 'Users List',
    'table_avatar' => 'Avatar',
    'table_username' => 'Username',
    'table_email' => 'Email',
    'table_role' => 'Role',



// edit_participant.php

    'edit_participant_title' => 'Edit Participant',
    'name_label' => 'Name:',
    'surname_label' => 'Surname:',
    'phone_label' => 'Phone:',
    'street_label' => 'Street:',
    'birthdate_label' => 'Birth Date:',
    'group_label' => 'Group:',
    'save_button' => 'Save',
    'back_button' => 'Back',
    'group_1' => 'Group 1',
    'group_2' => 'Group 2',
    'group_3' => 'Group 3',
    'group_4' => 'Group 4',



// edit_angajat.php

    'edit_employee_title' => 'Edit Employee',
    'name_label' => 'Name',
    'surname_label' => 'Surname',
    'salary_label' => 'Salary',
    'phone_label' => 'Phone Number',
    'experience_label' => 'Experience (years)',
    'employee_type_label' => 'Employee Type',
    'details_label' => 'Details (Instrument/Equipment/Materials)',
    'update_button' => 'Update Employee',
    'back_button' => 'Back',
    'music_option' => 'Music',
    'sports_option' => 'Sports',
    'drawing_option' => 'Drawing',
    'not_found_error' => 'Employee not found.',
    'update_success' => 'Employee updated successfully!',
    'update_error' => 'Update error: ',



// edit_activitate.php

    'edit_activity_title' => 'Edit Activity',
    'name_label' => 'Name:',
    'difficulty_level_label' => 'Difficulty Level:',
    'duration_label' => 'Duration:',
    'save_button' => 'Save',
    'back_button' => 'Back',
    'beginner_option' => 'Beginner',
    'intermediate_option' => 'Intermediate',
    'advanced_option' => 'Advanced',
    'not_found_error' => 'Activity not found.',



// delete_participant.php

    'delete_success' => 'Participant successfully deleted!',
    'delete_error' => 'Error deleting participant.',



// delete_angajat.php


    'delete_success' => 'Employee successfully deleted!',
    'delete_error' => 'Error deleting employee!',



// delete_activitate.php

    'delete_activity_success' => 'Activity successfully deleted!',
    'delete_activity_error' => 'Error deleting activity.',
    'activity_not_found' => 'Activity not found.',
    'delete_confirmation' => 'Are you sure you want to delete this activity?',
    'delete_button' => 'Delete',
    'cancel_button' => 'Cancel',



// dashboard.php


    'welcome_message' => 'Welcome,',
    'role_label' => 'Role:',
    'dashboard_intro' => 'We are thrilled to have you on the team at Palatul Copiilor Cluj-Napoca. This dashboard provides quick access to all the functionalities you need for managing activities, schedules, and participants.',
    'actions_header' => 'What you can do in this app:',
    'card_participants_title' => 'Participants List',
    'card_participants_text' => 'View and manage the list of all children enrolled in courses.',
    'card_employees_title' => 'Employees List',
    'card_employees_text' => 'View the complete list of employees in the institution.',
    'card_schedules_title' => 'Schedules',
    'card_schedules_text' => 'View all schedules created by participants.',
    'card_payments_title' => 'Payments',
    'card_payments_text' => 'Monitor and manage the status of completed payments.',
    'card_activities_title' => 'Activities',
    'card_activities_text' => 'View and manage the list of available activities.',
    'card_profile_title' => 'My Profile',
    'card_profile_text' => 'Manage your personal data and avatar.',
    'help_text' => 'If you need assistance or encounter any issues, please contact an administrator.',



// activitati.php

    'activities_list_title' => 'Activity List',
    'search_name_label' => 'Search by Name:',
    'search_level_label' => 'Difficulty Level:',
    'search_button' => 'Search',
    'reset_button' => 'Reset',
    'add_activity_button' => 'Add Activity',
    'table_code' => 'Code',
    'table_name' => 'Name',
    'table_level' => 'Difficulty Level',
    'table_duration' => 'Duration',
    'table_actions' => 'Actions',
    'edit_button' => 'Edit',
    'delete_button' => 'Delete',
    'delete_confirmation' => 'Are you sure you want to delete this activity?',
    'no_results' => 'No activities found for the selected criteria.',



// angajati.php

    'employees_list_title' => 'Employee List',
    'filter_label' => 'Filter by Type:',
    'filter_all' => 'All',
    'filter_music' => 'Music',
    'filter_sport' => 'Sport',
    'filter_drawing' => 'Drawing',
    'filter_button' => 'Filter',
    'reset_button' => 'Reset',
    'add_employee_button' => 'Add Employee',
    'table_code' => 'Code',
    'table_name' => 'Name',
    'table_surname' => 'Surname',
    'table_salary' => 'Salary',
    'table_phone' => 'Phone Number',
    'table_experience' => 'Experience',
    'table_type' => 'Type',
    'table_materials' => 'Materials',
    'table_actions' => 'Actions',
    'edit_button' => 'Edit',
    'delete_button' => 'Delete',
    'delete_confirmation' => 'Are you sure you want to delete this employee?',
    'no_results' => 'No employees found for the selected filter.',



// includes/activitati.php

    'activities_list_title' => 'List of Activities',
    'table_code' => 'Code',
    'table_name' => 'Name',
    'table_difficulty' => 'Difficulty Level',
    'table_duration' => 'Duration',


// add_programare.php

    'add_appointment_title' => 'Add Appointment',
    'date_label' => 'Appointment Date',
    'start_time_label' => 'Start Time',
    'end_time_label' => 'End Time',
    'activity_label' => 'Activity',
    'submit_button' => 'Add Appointment',
    'back_button' => 'Back',
    'error_empty_fields' => 'All fields are required.',
    'error_insert_failed' => 'An error occurred while adding the appointment.',
    'success_insert' => 'The appointment was successfully added!',



// add_participant.php

    'add_participant_title' => 'Add Participant',
    'add_participant_header' => 'Add Participant',
    'name_label' => 'Name:',
    'surname_label' => 'Surname:',
    'phone_label' => 'Phone:',
    'address_label' => 'Address:',
    'birth_date_label' => 'Birth Date:',
    'group_label' => 'Group:',
    'group_1' => 'Group 1',
    'group_2' => 'Group 2',
    'group_3' => 'Group 3',
    'group_4' => 'Group 4',
    'add_button' => 'Add',
    'back_button' => 'Back',



// add_angajat.php

    'add_employee_title' => 'Add Employee',
    'name_label' => 'Name',
    'surname_label' => 'Surname',
    'salary_label' => 'Salary',
    'phone_label' => 'Phone Number',
    'experience_label' => 'Experience (years)',
    'employee_type_label' => 'Employee Type',
    'type_music' => 'Music',
    'type_sport' => 'Sport',
    'type_art' => 'Art',
    'details_label' => 'Details (Instrument/Equipment/Materials)',
    'add_button' => 'Add Employee',
    'back_button' => 'Back',
    'employee_add_success' => 'Employee added successfully!',
    'employee_add_error' => 'Error adding employee: ',



// add_activitate.php

    'add_activity_title' => 'Add Activity',
    'activity_name_label' => 'Activity Name:',
    'activity_name_placeholder' => 'Enter activity name',
    'difficulty_level_label' => 'Difficulty Level:',
    'level_beginner' => 'Beginner',
    'level_intermediate' => 'Intermediate',
    'level_advanced' => 'Advanced',
    'duration_label' => 'Duration:',
    'duration_placeholder' => 'Duration (e.g., 2 hours)',
    'add_button' => 'Add Activity',
    'back_button' => 'Back',
    'activity_add_success' => 'Activity added successfully!',
    'activity_add_error' => 'Error adding activity: ',



// acces_denied.php

    'access_denied_title' => 'Acces interzis',
    'access_denied_message' => 'Ne pare rău, dar nu aveți permisiunea de a accesa această pagină.',
    'access_denied_return' => 'Vă rugăm să reveniți la',
    'access_denied_dashboard_link' => 'pagina principală',
    'access_denied_back_button' => 'Înapoi la Acasă',



// header.php

    'site_title' => 'Children\'s Palace Cluj',
    'dashboard' => 'Dashboard',
    'participants' => 'Participants',
    'employees' => 'Employees',
    'activities' => 'Activities',
    'appointments' => 'Appointments',
    'payments' => 'Payments',
    'users' => 'Users',
    'my_profile' => 'My Profile',
    'login' => 'Login',
    'register' => 'Register',
    'logout' => 'Logout',
    'my_appointments' => 'My Appointments',


    'button_show_details' => 'Show Details',
    'button_hide_details' => 'Hide Details',


    'button_access' => 'Access',
    'button_actualizare' => 'Update',



];


?>
