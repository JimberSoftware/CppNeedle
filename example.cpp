// THIS IS HOW I WOULD DO IT
class IApiRepo {
    public:
    virtual void DoSomething() = 0;  
};
class ApiRepo : public IApiRepo {
    DEPEND(ApiRepo)
    public:
    void DoSomething(){
        std::cout << "Hello";
    }
};


class LogoutInteraction {
    
    DEPEND1(LogoutInteraction, ApiRepo)
 //   SHARED(IApiRepo) thisApiRepo;
    public:
    void Handle(){
        thisApiRepo->DoSomething();
    }


};

int main()
{

    auto interaction = LogoutInteraction::Get();
    interaction.Handle();

}