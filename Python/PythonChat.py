import socket
s=socket.socket(socket.AF_INET , socket.SOCK_STREAM)
ip="localhost"
port=1235
s.bind((ip,port))
s.listen()
c=s.accept()
print("Connection Established")
f=open("log.txt", mode='w+')
while True:
    x=c[0].recv(1024).decode()
    print(c[1][0] + ": " + x)
    f.write(c[1][0] + ": " + x + "\n")
    if "bye" in x:
            print("Client Has Been Logout")
            s.close()
            exit()
    t1=input("You: ")
    f.write("You: "+t1 +"\n")
    if "bye" in t1:
        print("Thank You For Using, Bye")
        s.close()
        exit()
    c[0].send(t1.encode())
f.close()
