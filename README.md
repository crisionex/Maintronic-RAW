# Maintronic-RAW
Base functionalities of the project Maintronic, this project is used in industrial enviroments, more specifically on maintenance department, allows the users to create reports/forms based on the status of the equipment and the maintenance needed. 

Is important to know that this is not a complete version of the project and is just a demo, even though it show complete functionalities and capabilities of the project.

# 1 Sructure
The structure of the project is based on a dashboard, and we can interact with different sub-systems or blocks inside the dashboard such as:

## creation of users:
the first thing is the creation of users on the system, first we have two differet roles on the application.
 * supervisor/administrator: this user is on charge of the administrative part of the system, such as data analizing, validate or reject reports, create new users on the system, check the status of the equipment, upload new equipment and manage accounts.
 * Technician: this user is in charge of generate the forms and give the equipment the maintenance needed that later are reviewed by the supervisor.
 
## 1.1 Login:

Functioning as the initial screen for the user who accesses the application, where depending on the position they hold, they may be in charge, or technician, linked to their email registered in the management section that will be seen later, they will be able to access the application complete, in the case of a manager, or only to the reports section, being a technician.

## 1.2 Validation screens
In this section the following validation sections are located, which are those of a validated report, and its displayed screen where it indicates a successful validation in the system, a validation previously carried out where it displays a specific message for previously validated reports, and a last one for those that were previously rejected, the latter in case you want to perform a validation using the QR code on a report that has already been rejected.

### 1.2.1 Validated

This screen is displayed when a manager performs a remote authorization using the QR code, this is done with a cell phone, allowing if a report was filled out correctly, they can easily make it valid and let them know that the machine will be working.

### 1.2.2 Previously validated

When a manager uses the QR code for a report that was previously validated by another manager, this message will be displayed, assuming that the maintenance was carried out successfully and the machine is already in a functional state.

### 1.2.3 Rejected

If a person in charge, due to some carelessness, uses the QR code function to validate a report that was previously rejected, this message will be displayed, letting him know that the report he wanted to validate did not meet the necessary characteristics and was previously rejected, not being able to complete the request made.

## 1.3 User management

In this section managers can create new accounts for new managers or technicians who are joining the company, with a table that displays all users registered so far with their names and emails, as well as the role assigned to them, and on the right side all the data that is necessary to register any new user who wants to be entered.

# 2 System functionalities

## 2.1 Log

This section works as the main menu when entering the page having the role of manager, where you can find as main information the number of reports that are waiting, those that have already been reviewed, and the maintenance that is pending, with an updates section where those who have uploaded reports will appear, a general analysis where it shows the status of the total equipment, showing in percentage the amount that is operational, in maintenance, and non-operational, finally having a graph that would display in a line of time failures and maintenance performed per month.

## 2.2 Inventory

Here you will find all the inventory that is available, being the machines that are in each station, with an option to add new equipment that is acquired over time, as well as the one that you currently have, with your code and a brief description of what it is, as well as the condition in which it is being the current state of the machine, if it is operating, in maintenance, or not operational, and for the moment this state can be edited manually to show what would happen if it is detected that a machine stopped operating, and since it is sent directly to maintenance where a report will have to be generated.

### 2.2.1 Add team:

We add to the app's inventory catalog the equipment or classification of the equipment that are available or in existence.
### 2.2.2 Edit Team Status:

Here, based on the evaluation of the reports, the state in which the equipment is found is designated to know its situation in case of requiring maintenance, being carried out manually by a person in charge.

## 2.3 Validations

All the reports that need to be validated by the maintenance managers will appear on this screen, with the option of validating them through the QR code that will appear in the generated report.

## 2.4 Reports

We appreciate the visualization of the reports in addition to seeing which ones were rejected and accepted, as well as observing if there is any type of report pending completion, thus being able to enter the next section of forms.

### 2.4.1 Forms

Area where we take care of the generation of the reports specifying the details within it as well as the information regarding who generated it and why, also detailing what was found in the machine as well as the observations that may denote.

### 2.4.2 Viewing reports

In this section it will show us the reports that were previously validated or rejected, managing to maintain a history and record of the maintenance carried out on the inventory that is held.
