set terminal png size 600
set output "grafica50010000.png"
set title "Grafica 500 - 10000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
plot "ejer350010000.csv" using 9 smooth sbezier with lines title "Ejercicio3"
set terminal png size 600
set output "grafica50010000.png"
set title "Grafica 500 - 10000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer450010000.csv" using 9 smooth sbezier with lines title "Ejercicio4"
set terminal png size 600
set output "grafica50010000.png"
set title "Grafica 500 - 10000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer550010000.csv" using 9 smooth sbezier with lines title "Ejercicio5"
