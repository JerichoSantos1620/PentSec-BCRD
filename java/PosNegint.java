
import java.util.Scanner;
/**
 *
 * @author Jericho
 */
public class PosNegint {

    public static void main(String[] args) {
        Scanner myInt = new Scanner(System.in);
        System.out.print("Enter an Integer: ");
        int myInteger = myInt.nextInt();
        if (myInteger > 0) {
            System.out.println(myInteger + " is a positive integer.");
        }
        else if (myInteger < 0) 
        {
            System.out.println(myInteger + " is a negative integer.");
        }
        else 
        {
            System.out.println(myInteger + " is both positive and negative integer.");
        }
        
    }
}

