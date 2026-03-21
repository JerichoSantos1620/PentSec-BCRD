#include <iostream>

void happyBirthday(std::string name, int age);

int main()
{
    // function = a block of reusable code 

    std::string name = "Jericho";\
    int age =21;

    happyBirthday(name, age);
    

    return 0;
}

void happyBirthday(std::string name, int age){
    std::cout << "Hapyy Birthday to " << name << '\n';
    std::cout << "Hapyy Birthday to " << name << '\n';
    std::cout << "Hapyy Birthday dear " << name << '\n';
    std::cout << "Hapyy Birthday to " << name << '\n';
    std::cout << "You are " << age << " years old!\n";

}

