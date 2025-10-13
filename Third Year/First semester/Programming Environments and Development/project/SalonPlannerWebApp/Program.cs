using Microsoft.EntityFrameworkCore;
using Microsoft.Extensions.DependencyInjection;
using SalonPlannerWebApp.Data;
using Microsoft.AspNetCore.Identity;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddAuthorization(options =>
{
    options.AddPolicy("AdminPolicy", policy =>
        policy.RequireRole("Admin")); // politica pentru utilizatorii cu rol de admin
});

builder.Services.AddRazorPages(options =>
{
    options.Conventions.AuthorizeFolder("/"); // restrictioneaza toate paginile pentru utilizatorii autentificati
    options.Conventions.AllowAnonymousToPage("/Index");
    options.Conventions.AllowAnonymousToPage("/Account/Login");
    options.Conventions.AllowAnonymousToPage("/Account/Register");
    options.Conventions.AllowAnonymousToPage("/Services/Index");
    options.Conventions.AllowAnonymousToPage("/Services/Details");
});

builder.Services.AddDbContext<SalonPlannerWebAppContext>(options =>
    options.UseSqlServer(builder.Configuration.GetConnectionString("SalonPlannerWebAppContext") ?? throw new InvalidOperationException("Connection string 'SalonPlannerWebAppContext' not found.")));

builder.Services.AddDbContext<SalonPlannerWebApp.Data.SalonIdentityContext>(options =>
    options.UseSqlServer(builder.Configuration.GetConnectionString("SalonPlannerWebAppContext") ?? throw new InvalidOperationException("Connection string 'SalonPlannerWebAppContext' not found.")));

builder.Services.AddDefaultIdentity<IdentityUser>(options => options.SignIn.RequireConfirmedAccount = true)
    .AddRoles<IdentityRole>() // adauga suport pentru roluri
    .AddEntityFrameworkStores<SalonIdentityContext>();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (!app.Environment.IsDevelopment())
{
    app.UseExceptionHandler("/Error");
    app.UseHsts();
}

//Middleware services
app.UseHttpsRedirection();
app.UseStaticFiles();

app.UseRouting();

app.UseAuthentication(); 
app.UseAuthorization();

app.MapRazorPages();


app.Run();
