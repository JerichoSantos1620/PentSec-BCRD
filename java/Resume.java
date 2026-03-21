import java.util.Scanner;

public class Resume {
    public static void main(String[] args) {
        Scanner input = new Scanner (System.in);
        String name;
        String address;
        String year;
        String course;
        int age;        
        
        System.out.println("-----------------------------------------------");
        System.out.println("RESUME");
        System.out.println("-----------------------------------------------");
        System.out.println("");
        System.out.println("");
        
        System.out.println("-----------------------------------------------");
        System.out.print("Enter your Fullname: ");
        name = input.nextLine();
        System.out.print("Enter your Address: ");
        address = input.nextLine();
        System.out.print("Enter your year level: ");
        year = input.nextLine();
        System.out.print("Enter your course: ");
        course = input.nextLine();
        System.out.print("Enter your age: ");
        age = input.nextInt();
        
        System.out.println("-----------------------------------------------");
        System.out.println("");
        System.out.println("");

        System.out.println("-----------------------------------------------");
        System.out.println("Hello " + name);
        System.out.println("You live in " + address);
        System.out.println("Your year level is " + year);
        System.out.println("Your course is " + course);
        System.out.println("Your are " + age + " years old");
        System.out.println("-----------------------------------------------");

        System.out.println("");
        System.out.println("");

        System.out.println("THANK YOU!!!");
        System.out.println("-----------------------------------------------");
    }
}
