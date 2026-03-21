public class practice {
    public static void main(String[] args) {

        String x = "Reverse";
        String y = "The word";
        String temp;

        temp = x;
        x=y;
        y = temp;

        System.out.println("x: "+x);
        System.out.println("y: "+y);

    }

}

/*
 * String x = "water";
 * String y = "Kool-aid";
 * String temp;
 * 
 * temp=x;
 * x=y;
 * y=temp;
 * 
 * System.out.println("x: "+x);
 * System.out.println("y: "+y);
 */