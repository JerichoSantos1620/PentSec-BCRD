import java.util.Scanner;
public class Currency {
    public static void main(String[] args) {
        
        double usdToPhp = 43.33089;
        double phpToEuro = 0.734719;
        double phpToYuan = 6.346934;
        double phpToKoruna = 18.77263;
        double phpToKrone = 5.449007;
        double phpToShekel = 3.726334;
        double phpToDinar = 0.274588;

        Scanner scanner = new Scanner(System.in);
        System.out.println("-------------------------------------------");
        System.out.println("Currency Calculator");
        System.out.println("-------------------------------------------");
        System.out.println("");
        System.out.println("");
        System.out.print("Enter Philippine Peso: ");
        double phpAmount = scanner.nextDouble();
        
        double usdAmount = phpAmount/usdToPhp;
        double euroAmount = usdAmount/phpToEuro;
        double yuanAmount = usdAmount/phpToYuan;
        double korunaAmount = usdAmount/phpToKoruna;
        double kroneAmount = usdAmount/phpToKrone;
        double shekeAmount = usdAmount/phpToShekel;
        double dinarAmount = usdAmount/phpToDinar;
        
        System.out.println("-------------------------------------------");
        System.out.println();
        System.out.printf("The amount's equivalent to: \n\n");
        System.out.printf("Us Dollar is in %.3f \n" , usdAmount);
        System.out.printf("Euro is in %.6f \n" , euroAmount);
        System.out.printf("Yuan is in %.6f \n" , yuanAmount);
        System.out.printf("Koruna is in %.5f \n" , korunaAmount);
        System.out.printf("Krone is in %.6f \n" , kroneAmount);
        System.out.printf("Shekel is in %.6f \n" , shekeAmount);
        System.out.printf("Dinar is in %.6f \n\n" , dinarAmount);
        System.out.println("-------------------------------------------");
        
        System.out.println("-------------------------------------------");
        System.out.println("END");
        System.out.println("-------------------------------------------");

    }
}
