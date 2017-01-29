#include <iostream>
#include <string>
#include <vector>
#include <memory>


// THIS IS HOW I WOULD DO IT
class IApiRepo {
    public:
    virtual void DoSomething() = 0;  
};


class ApiRepo : public IApiRepo {
    public:
    void DoSomething() override{
        std::cout << "Hello";
    }
    static ApiRepo Get(){
        static ApiRepo object;
        return object;
    }
};

class RegisterInteraction {
	
	private:
	    std::shared_ptr<IApiRepo> repo;

	public:
	
	 RegisterInteraction(std::shared_ptr<IApiRepo> repo) : repo(repo) {

	}
	 void Handle(){
	    this->repo->DoSomething();
	    
	}
	
	static RegisterInteraction Get(){
	    static RegisterInteraction object(std::make_shared<ApiRepo>(ApiRepo::Get()));
	    return object;
	}
	
	
};

int main()
{
    auto interaction = RegisterInteraction::Get();
    interaction.Handle();

    
}

