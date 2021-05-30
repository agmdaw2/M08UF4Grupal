set terminal png size 600
set output "grafica5005000.png"
set title "Grafica 500 - 5000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
plot "ejer35005000.csv" using 9 smooth sbezier with lines title "Ejercicio3"
set terminal png size 600
set output "grafica5005000.png"
set title "Grafica 500 - 5000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer45005000.csv" using 9 smooth sbezier with lines title "Ejercicio4"
set terminal png size 600
set output "grafica5005000.png"
set title "Grafica 500 - 5000"
set size ratio 0.6
set grid y
set xlabel "Peticiones"
set ylabel "Tiempo de Respuesta (ms)"
replot "ejer55005000.csv" using 9 smooth sbezier with lines title "Ejercicio5"
