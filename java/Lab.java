import java.util.Scanner;

public class Lab {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        String continueCalculation;

        do {
            // Input the bank balance
            System.out.print("Enter the initial bank account balance: ");
            double balance = scanner.nextDouble();

            // Input the interest rate
            System.out.print("Enter the annual interest rate (in percentage, e.g., 5 for 5%): ");
            double annualRate = scanner.nextDouble();
            double rate = annualRate / 100;

            // Calculate and display the account value for 10 years using different
            // compounding methods
            double annualBalance = calculateCompoundInterest(balance, rate, 1, 10);
            double monthlyBalance = calculateCompoundInterest(balance, rate, 12, 10);
            double dailyBalance = calculateCompoundInterest(balance, rate, 365, 10);

            System.out.printf("Account value after 10 years when compounded annually: %.2f\n", annualBalance);
            System.out.printf("Account value after 10 years when compounded monthly: %.2f\n", monthlyBalance);
            System.out.printf("Account value after 10 years when compounded daily: %.2f\n", dailyBalance);

            // Ask user if they want to perform another calculation
            System.out.print("Do you want to enter a new balance and interest rate? (yes/no): ");
            continueCalculation = scanner.next();

        } while (continueCalculation.equalsIgnoreCase("yes"));

        System.out.println("Program terminated.");
    }

    // Method to calculate the future value using compound interest
    public static double calculateCompoundInterest(double initialBalance, double rate, int timesPerYear, int years) {
        double balance = initialBalance;
        double periodRate = rate / timesPerYear; // Calculate the interest rate for each period

        // Loop to add interest for each time period over the total number of periods
        for (int period = 1; period <= timesPerYear * years; period++) {
            balance += balance * periodRate;

        }

        return balance;
    }
}
