set terminal png size 600
set output "grafica50050000.png"
set title "Grafica 500 - 50000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
plot "ejer350050000.csv" using 9 smooth sbezier with lines title "Ejercicio3"
set terminal png size 600
set output "grafica50050000.png"
set title "Grafica 500 - 50000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer450050000.csv" using 9 smooth sbezier with lines title "Ejercicio4"
set terminal png size 600
set output "grafica50050000.png"
set title "Grafica 500 - 50000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer550050000.csv" using 9 smooth sbezier with lines title "Ejercicio5"
