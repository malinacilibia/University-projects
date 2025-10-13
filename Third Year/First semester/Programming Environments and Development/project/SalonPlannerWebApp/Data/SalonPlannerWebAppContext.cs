using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using SalonPlannerWebApp.Models;

namespace SalonPlannerWebApp.Data
{
    public class SalonPlannerWebAppContext : DbContext
    {
        public SalonPlannerWebAppContext (DbContextOptions<SalonPlannerWebAppContext> options)
            : base(options)
        {
        }

        public DbSet<SalonPlannerWebApp.Models.Employee> Employee { get; set; } = default!;
        public DbSet<SalonPlannerWebApp.Models.Service> Service { get; set; } = default!;
        public DbSet<SalonPlannerWebApp.Models.Category> Category { get; set; } = default!;
        public DbSet<SalonPlannerWebApp.Models.Client> Client { get; set; } = default!;
        public DbSet<SalonPlannerWebApp.Models.Appointment> Appointment { get; set; } = default!;
        public DbSet<SalonPlannerWebApp.Models.Feedback> Feedback { get; set; } = default!;
    }
}
