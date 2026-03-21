#include <iostream>
#include <cstdlib>
using namespace std;
typedef int *IntPtr;

int main()
{
    IntPtr p;
    int a[10];

    for (int i=0; i<10; i++)
        a[i] = i;

    cout <<"Contents of array a...\n";
    for (int i=0; i<10; i++)
        cout << a[i] << " ";

    p = a;
    cout <<"\nContents pointed to by pointer p...\n";
    for (int i=0; i<10; i++)
        cout << p[i] << " ";

    for (int i=0; i<10; i++)
        p[i] = p[i] + 1;
    
    cout <<"\nNew contents of array after processing ...\n";
    for (int i=0; i<10; i++)
        cout << a[i] << " ";   
    
    cout << "\n";
    system("pause");
}