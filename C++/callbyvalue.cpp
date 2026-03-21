#include <iostream>
#include <cstdlib>
using namespace std;
typedef int *Intptr;
void sneaky(Intptr temp);

int main()
{
        Intptr p;
        p = new int;
        *p = 77;
        cout << "Value point to by p: " << *p << endl;
        sneaky(p);
        cout << "Value point to by p: " << *p << endl;
        system("pause");
}

void sneaky(Intptr temp)
{
    *temp = 99;
    cout << "Value point to by temp: " << *temp << endl;
}