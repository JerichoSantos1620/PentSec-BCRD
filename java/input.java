
import java.util.Scanner;
public class input {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.print("Please Enter your Fullname: ");
        String name = scanner.nextLine();
        System.out.print("How old are you?: ");
        int age = scanner.nextInt();
        scanner.nextLine();
        System.out.print("Where do you live: ");
        String address = scanner.nextLine();

        System.out.println("Hello "+name);
        System.out.println("You are "+age + " years old");
        System.out.println("You live in: "+address);

        scanner.close();
    }
    
}
