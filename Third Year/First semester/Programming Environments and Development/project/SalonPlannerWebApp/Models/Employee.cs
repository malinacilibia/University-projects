using System.ComponentModel.DataAnnotations;

namespace SalonPlannerWebApp.Models
{
    public class Employee
    {
        [Key]
        public int Id { get; set; }

        [RegularExpression(@"^[A-Z]+[a-zA-Z\s-]*$", ErrorMessage = "Prenumele trebuie sa inceapa cu majuscula")]
        [Required]
        [Display(Name = "Prenume")]
        public string FirstName { get; set; }

        [RegularExpression(@"^[A-Z]+[a-zA-Z\s-]*$", ErrorMessage = "Numele trebuie sa inceapa cu majuscula")]
        [Required]
        [Display(Name = "Nume")]
        public string LastName { get; set; }


        [EmailAddress(ErrorMessage = "Introduceti un email valid.")]
        public string Email { get; set; }


        [Phone(ErrorMessage = "Introduceti un numar de telefon valid.")]
        [Display(Name = "Numar de telefon")]
        public string Phone { get; set; }

        [StringLength(250)]
        [Display(Name = "Pozitie")]
        public string Position { get; set; }


        [Range(1, 50)]
        [Display(Name = "Ani experienta")]
        public int Experience { get; set; }


        [StringLength(250)]
        [Display(Name = "Studii")]
        public string Studies { get; set; }


         [Display(Name = "Nume angajat")]
        public string FullName
        {
            get
            {
                return FirstName + " " + LastName;
            }
        }
        public ICollection<Appointment>? Appointments { get; set; }
        public ICollection<Feedback>? Feedbacks { get; set; }


    }
}
