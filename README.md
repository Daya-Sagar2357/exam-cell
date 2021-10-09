# Exam Cell Automation

Exam cell automation aims to make the manual seating allocation of students during exam seasons, automated. In addition to this, the original architecture has built modules that automates staff allocation, document generation etc as well, which are under development.

## Installation

Clone the git link into the htdocs folder of your xampp directory, if using xampp. 

```bash
git clone https://github.com/Daya-Sagar2357/exam-cell.git
```

## Usage

The Database directory in the cloned folder has sample SQL queries to load data into the database. Go to `http://localhost/phpmyadmin/` to run the commands and further access the data if necessary.

The program will be available in `http://localhost/exam-cell/`. Alternately, you can also go to ```http://localhost/exam-cell/get_started```. The sample data that has now been added can be used to generate corresponding seating allocations using the generate button on the home page accessible by the link mentioned above. 

The user will be redirected to a Generated Seating page where they can edit the generated seating throug dragging and dropping the Register Numbers. The drop zones where dropping of an element is allowed is indicated in a lighter color.

_Open console logs to see editted changes reflected in the data dynamically._


## For further development

The code has been written in MVC format using Code Igniter. The main controller is **get_started.php** inside the controllers folder in the application directory. 

The model starter.php is where the seating allocation code is. Additionally, the drag and drop through UI is in **views/pages/seating.php**.

_(Refer the code comments for additional information. Also refer the img folder in the application directory itself.)_
