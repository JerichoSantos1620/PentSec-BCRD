#include <iostream>
#include <cstdlib>
using namespace std;

int main()
{
    int x(7), y(10), *p1, *p2;

    p1 = &x;
    p2 = &y;
    cout << "Initial values..." << endl;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Dereference 1 ... (p1=p2)" << endl;
    
    p1 = p2;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Change the value of y (y=20) ..." << endl;

    y=20;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Change the value of x (x= *p1+y) ..." << endl;

    x = *p1 + y;
    cout << "Initial values..." << endl;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Dereference 2 ... (p2=&x)" << endl;

    p2 = &x;
    cout << "Initial values..." << endl;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Dereference 3 ... (*p2=x+y+5)" << endl;

    *p2 = x + y + 5; 
    cout << "Initial values..." << endl;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    cout << "Dereference 4 ... (p2=p1)" << endl;

    p2=p1;
    cout << "x=" << x << " | y=" << y 
    << " | p1=" << *p1 << " | p2=" << *p2 << endl<< endl;
    system("pause");
    
    
}