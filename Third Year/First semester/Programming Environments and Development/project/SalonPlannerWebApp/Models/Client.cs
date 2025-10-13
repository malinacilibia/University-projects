using System.ComponentModel.DataAnnotations;

namespace SalonPlannerWebApp.Models
{
    public class Client
    {
        [Key]
        public int ID { get; set; }


        [RegularExpression(@"^[A-Z]+[a-zA-Z\s-]*$", ErrorMessage = "Prenumele trebuie sa inceapa cu majuscula")]
        [Display(Name = "Prenume")]
        [StringLength(50)]
        public string? FirstName { get; set; }


        [RegularExpression(@"^[A-Z]+[a-zA-Z\s-]*$", ErrorMessage = "Numele trebuie sa inceapa cu majuscula")]
        [Display(Name = "Nume")]
        [StringLength(50)]
        public string? LastName { get; set; }


        [Display(Name = "Adresa")]
        [StringLength(250)]
        public string? Address { get; set; }


        [Display(Name = "Email")]
        [Required]
        [EmailAddress]
        public string Email { get; set; }


        [Display(Name = "Telefon")]
        [Phone]
        public string? Phone { get; set; }


        [Display(Name = "Nume client")]
        public string FullName
        {
            get
            {
                return FirstName + " " + LastName;
            }
        }

        public ICollection<Appointment>? Appointments { get; set; }
    }
}
