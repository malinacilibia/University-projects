using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace SalonPlannerWebApp.Models
{
    public class Service
    {
        [Key]
        public int ID { get; set; }


        [Display(Name = "Nume serviciu")]
        [Required]
        [StringLength(100)]
        public string Name { get; set; }


        [Display(Name = "Descriere")]
        [StringLength(250)]
        public string Description { get; set; }


        [Display(Name = "Pret")]
        [Range(0.0, 1000.0)]
        public decimal Price { get; set; }


        [Display(Name = "Durata")]
        [Range(1, 240)]
        public int Duration { get; set; }

        public ICollection<ServiceCategory>? ServiceCategories { get; set; }
        public ICollection<Appointment>? Appointments { get; set; }
        public ICollection<Feedback>? Feedbacks{ get; set; }


    }
}
