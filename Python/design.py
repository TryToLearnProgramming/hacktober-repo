n = int(input().split()[0])
halfmat = ""
for i in range(1, (n+1)//2):
    newline = "-" * (3 * ((n + 1) // 2 - i)) + ".|." * (2 * i - 1) + "-" * (3 * ((n + 1) // 2 - i)) + "\n"
    halfmat += newline
mat = halfmat + "-" * ((3 * n - 7) // 2) + "WELCOME"+ "-" * ((3 * n - 7) // 2) + halfmat[::-1]
print(mat)