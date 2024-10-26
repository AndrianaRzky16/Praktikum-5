<?php
class Queue
{
 private $queue;
 private $limit;

 public function __construct($limit = 20)
 {
  $this->queue = [];
  $this->limit = $limit;
 }

 public function enqueue($item)
 {
  if (count($this->queue) < $this->limit) {
   array_push($this->queue, $item);
  } else {
   echo "Queue penuh, tidak bisa menambah data.\n";
  }
 }

 public function dequeue()
 {
  if ($this->isEmpty()) {
   return "Queue kosong, tidak ada data untuk diproses.";
  } else {
   return array_shift($this->queue);
  }
 }

 public function front()
 {
  return reset($this->queue);
 }

 public function rear()
 {
  return end($this->queue);
 }

 public function isEmpty()
 {
  return empty($this->queue);
 }
}

// Queue untuk data IoT
$iotDataQueue = new Queue(20);

// Fungsi untuk menerima data dari perangkat IoT
function receiveIoTData($queue, $data)
{
 echo "Menerima data IoT: " . $data . "\n";
 $queue->enqueue($data);
}

// Fungsi untuk memproses data secara batch
function processBatchData($queue, $batchSize)
{
 $batch = [];
 for ($i = 0; $i < $batchSize; $i++) {
  if (!$queue->isEmpty()) {
   $batch[] = $queue->dequeue();
  } else {
   break;
  }
 }
 echo "Processing batch data: " . implode(", ", $batch) . "\n";
}

// Simulasi menerima data dari perangkat IoT
echo "231232017 Andriana Rizki Barokah \n";
echo "=============================================\n\n";

receiveIoTData($iotDataQueue, "Temperature: 22C");
receiveIoTData($iotDataQueue, "Humidity: 45%");
receiveIoTData($iotDataQueue, "Light: 350 Lux");

// Proses data dalam batch ukuran 2
processBatchData($iotDataQueue, 2);

// Menampilkan data di front dan rear antrian
echo "Front of Queue: " . $iotDataQueue->front() . "\n";
echo "Rear of Queue: " . $iotDataQueue->rear() . "\n";
