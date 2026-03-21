#include <iostream>
#include <cstdlib>
using namespace std;

typedef int *IntPtr;

int main()
{
    IntPtr p1, p2;
    p1 = new int;
    *p1 = 100;
    cout << "Value point to by p1: " << *p1 << endl;
    p2 = p1;
    cout << "Value point to by p2: " << *p2 << endl;
    system("pause");
}