using System;
using System.ComponentModel.DataAnnotations;

namespace SalonPlannerWebApp.Models
{
    public class Feedback
    {
        public int ID { get; set; }

        public int? EmployeeID { get; set; }
        public Employee? Employee { get; set; }

        public int? ServiceID { get; set; }
        public Service? Service { get; set; }


        [Display(Name = "Comentariu")]
        [Required]
        [StringLength(500)]
        public string Comments { get; set; } = default!;


        [Required]
        [Range(1, 5)] // Nota trebuie să fie între 1 și 5
        public int Rating { get; set; }


        [Display(Name = "Data")]
        [DataType(DataType.Date)]
        [Required]
        public DateTime Date { get; set; }

    }
}
