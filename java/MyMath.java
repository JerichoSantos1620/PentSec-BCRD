import java.util.Scanner;

public class MyMath {
    public static void main(String[] args) {
        
        double x;
        double y;
        double z;

        Scanner scanner = new Scanner(System.in);

        System.out.print("Enter Side x: ");
        x = scanner.nextDouble();
        System.out.print("Enter Side y: ");
        y = scanner.nextDouble();

        z = Math.sqrt((x*x)+(y*y));
    
        System.out.println("The hypotenuse is: " + z);

        scanner.close();
    }
}
