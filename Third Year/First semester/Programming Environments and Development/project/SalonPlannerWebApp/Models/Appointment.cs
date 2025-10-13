using System.ComponentModel.DataAnnotations;

namespace SalonPlannerWebApp.Models
{
    public class Appointment
    {
        [Key]
        public int ID { get; set; }


        public int? ClientID { get; set; }
        public Client? Client { get; set; }


        public int? EmployeeID { get; set; }
        public Employee? Employee { get; set; }


        public int? ServiceID { get; set; }
        public Service? Service { get; set; }


        [Display(Name = "Data")]
        [DataType(DataType.Date)]
        [Required]
        public DateTime Date { get; set; }


        [Display(Name = "Durata")]
        [Range(1, 480)]
        [Required]
        public int Duration { get; set; }


        public AppointmentStatus? Status { get; set; } = AppointmentStatus.Pending;

    }
}
