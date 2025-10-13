class CalculatorException(Exception):
    def __init__(self, message="Eroare"):
        super().__init__(message)
        self.message = message

    def getMessage(self):
        return self.message
    
class Calculator:
    def read(self):
        return input('> ')
    
    def eval(self, expresie):
        if not expresie:
            raise CalculatorException("")
        try:
            return self.verifica_expresie(expresie)
        except Exception as e:
            raise CalculatorException("Eroare " + str(e))
        
    def ordine(self, operatie):
        return 1 if operatie in ('+', '-') else 2 if operatie in ('*', '/') else 0
    
    def aplica_operator(self, s_operatori, s_operanzi):
        if len(s_operanzi) < 2:
            raise CalculatorException("Completeaza expresia")
        operator = s_operatori.pop()
        dreapta, stanga = s_operanzi.pop(), s_operanzi.pop()
        if operator == '+':
            s_operanzi.append(stanga + dreapta)
        elif operator == '-':
            s_operanzi.append(stanga - dreapta)
        elif operator == '*':
            s_operanzi.append(stanga * dreapta)
        elif operator == '/':
            if dreapta == 0:
                raise CalculatorException("Nu se poate imparti la 0")
            s_operanzi.append(stanga / dreapta)

    def verifica_expresie(self, expr):
        s_operanzi = []
        s_operatori = []
        i=0

        while i<len(expr):
            caracter=expr[i]

            if caracter in ' \t':
                i+=1
                continue
            if caracter == '(':
                s_operatori.append(caracter)
            elif caracter == ')':
                while s_operatori and s_operatori[-1] != '(':
                    self.aplica_operator(s_operatori, s_operanzi)
                s_operatori.pop()
            elif caracter.isdigit() or (caracter == '-' and (i == 0 or expr[i - 1] in '()')):
                inceput = i
                i += (1 if caracter == '-' else 0)
                while i < len(expr) and (expr[i].isdigit() or expr[i] == '.'):
                    i += 1
                s_operanzi.append(float(expr[inceput:i]))
                continue
            elif caracter in '+-*/':
                while s_operatori and self.ordine(s_operatori[-1]) >= self.ordine(caracter):
                    self.aplica_operator(s_operatori, s_operanzi)
                s_operatori.append(caracter)
            else:
                raise CalculatorException("Eroare")
            i += 1

        while s_operatori:
            self.aplica_operator(s_operatori, s_operanzi)

        if len(s_operanzi) != 1 or s_operatori:
            raise CalculatorException("Eroare")
        
        rezultat = s_operanzi[0]
        if rezultat.is_integer():  
             return int(rezultat)
        return rezultat    
        
    def loop(self):
        line = self.read()
        while line.strip().lower() != "quit":
            try:
                result = self.eval(line)
                print(result)
            except CalculatorException as e:
                print(e.getMessage())
            except ValueError as e:
                print(e.args[0])
            line=self.read()

if __name__ == '__main__':
    calc = Calculator()
    calc.loop()            