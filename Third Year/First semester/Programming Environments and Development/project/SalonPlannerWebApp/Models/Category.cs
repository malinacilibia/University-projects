using System.ComponentModel.DataAnnotations;

namespace SalonPlannerWebApp.Models
{
    public class Category
    {
        [Key]
        public int ID { get; set; }


        [Display(Name = "Nume")]
        [Required]
        [StringLength(50)]
        public string Name { get; set; }


        [Display(Name = "Descriere")]
        [StringLength(250)]
        public string? Description { get; set; }

        public ICollection<Service>? Services { get; set; }
    }
}
