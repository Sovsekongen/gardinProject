# ifndef ARRAYLIST_H
# define ARRAYLIST_H

template <typename T>
class ArrayList
{
public:
    ArrayList();

    // Copy constructor
    ArrayList(const ArrayList<T>& c);

    // Move constructor
    ArrayList (ArrayList<T>&& c) ;

/*
* Constructor with initialization of " initialized "
elements
*/
    ArrayList(int initialized);

    virtual ~ ArrayList() ;

/*
* Copy assignment operator
*/
    ArrayList<T>& operator =(const ArrayList<T>& a);

/*
* Move assignment operator
*/
    ArrayList<T>& operator =(ArrayList<T>&& a);


/*
* Add element to dynamic array
*/
    void add (const T& element)
    {
        if (_size == _reserved)
            extendStorage() ;

        _elems [_size] = element;
        ++ _size ;
    }

/*
* Inserts the element at placement " idx " in array andmoves the remaining
* items by one place , restoring the old element at " idx".
* check whether it is needed to extend the storage .
* move all elements from _size to idx ( reverse ) one element to the right in the array
* set _elems [ idx ] equal to the element to be inserted
*/
    void add(int idx, constT& element);
/*
* Get a const reference to the element at idx
*/
    const T& operator [](int idx) const ;

/*
* Get a reference to the element at idx
*/
    T& operator [](int idx);

/*
* Removes the element at placement " idx " by moving all the remaining elements
* by one place to the left in the array
*/
    void remove(int idx);

/*
* Returns the number of elements stored
*/
    int size() const;
/*
* Returns the number of items currently reserved in memory
*/
    int reserved() const;

/*
* Returns true if number of elements in array is zero
*/
    bool isEmpty() const;

/*
* Trims the storage array to the exact number of elements
* stored .
*/
    void trimToSize();

/*
* Sorts the array using insertion sort (or another algorithm )
*/
    void sort();

/*
* Returns a new ArrayList with elements from " fromIdx " index to " toIdx "
*/
    ArrayList<T> subArrayList(int fromIdx, int toIdx) const;

/*
* Returns a new C++ style array ( copy created with new ) with all elements
*/
    T* toArray();

private:
/*
* extendStorage ():
* create new array with size 2* _reserved
* copy old data to the new array
* delete old array
* update pointer _elems to point to the new array
* ( Since this method is private , the method will only be used internally ,
* but the functionality is needed ).
*/
    void extendStorage();

/*
* Member variables
*/
    int _reserved ; // The current capacity of " _elems " array
    int _size ; // The number of elements stored
    T* _elems ; // Array for storing the elements
};

# endif // ARRAYLIST_H
