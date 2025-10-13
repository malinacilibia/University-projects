using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace SalonPlannerWebApp.Migrations
{
    /// <inheritdoc />
    public partial class RemoveIdentityUser : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            // Elimină indexul pe coloana UserId
            migrationBuilder.DropIndex(
                name: "IX_Appointment_UserId",
                table: "Appointment");

            // Șterge constrângerea Foreign Key de pe UserId din tabela Appointment
            migrationBuilder.DropForeignKey(
                name: "FK_Appointment_IdentityUser_UserId",
                table: "Appointment");

            // Șterge coloana UserId din tabela Appointment
            migrationBuilder.DropColumn(
                name: "UserId",
                table: "Appointment");

            // Șterge tabela IdentityUser
            migrationBuilder.DropTable(
                name: "IdentityUser");
        }



        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            // Recreează tabela IdentityUser
            migrationBuilder.CreateTable(
                name: "IdentityUser",
                columns: table => new
                {
                    Id = table.Column<string>(type: "nvarchar(450)", nullable: false),
                    UserName = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    NormalizedUserName = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    Email = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    NormalizedEmail = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    EmailConfirmed = table.Column<bool>(type: "bit", nullable: false),
                    PasswordHash = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    SecurityStamp = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    ConcurrencyStamp = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    PhoneNumber = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    PhoneNumberConfirmed = table.Column<bool>(type: "bit", nullable: false),
                    TwoFactorEnabled = table.Column<bool>(type: "bit", nullable: false),
                    LockoutEnd = table.Column<DateTimeOffset>(type: "datetimeoffset", nullable: true),
                    LockoutEnabled = table.Column<bool>(type: "bit", nullable: false),
                    AccessFailedCount = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_IdentityUser", x => x.Id);
                });

            // Adaugă coloana UserId în tabela Appointment
            migrationBuilder.AddColumn<string>(
                name: "UserId",
                table: "Appointment",
                type: "nvarchar(450)",
                nullable: true);

            // Adaugă relația între UserId și IdentityUser
            migrationBuilder.AddForeignKey(
                name: "FK_Appointment_IdentityUser_UserId",
                table: "Appointment",
                column: "UserId",
                principalTable: "IdentityUser",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }

    }
}
