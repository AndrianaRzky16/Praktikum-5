<?php
class Stack
{
 private $stack;
 private $limit;

 public function __construct($limit = 10)
 {
  $this->stack = [];
  $this->limit = $limit;
 }

 public function push($item)
 {
  if (count($this->stack) < $this->limit) {
   array_push($this->stack, $item);
  } else {
   echo "Stack penuh, tidak bisa menambah perubahan.\n";
  }
 }

 public function pop()
 {
  if ($this->isEmpty()) {
   return "Tidak ada yang bisa di-undo.";
  } else {
   return array_pop($this->stack);
  }
 }

 public function peek()
 {
  return end($this->stack);
 }

 public function isEmpty()
 {
  return empty($this->stack);
 }
}

// Stack untuk operasi undo dan redo 
$undoStack = new Stack(10);
$redoStack = new Stack(10);

// Fungsi untuk menambahkan tindakan pengeditan 
function addEditAction($stack, $action)
{
 $stack->push($action);
}

// Fungsi Undo 
function undoAction($undoStack, $redoStack)
{
 $lastAction = $undoStack->pop();
 if ($lastAction != "Tidak ada yang bisa di-undo.") {
  echo "Undo action: " . $lastAction['action'] . " at " . $lastAction['time'] . "\n";
  $redoStack->push($lastAction);
 } else {
  echo $lastAction . "\n";
 }
}

// Fungsi Redo 
function redoAction($redoStack, $undoStack)
{
 $lastRedo = $redoStack->pop();
 if ($lastRedo != "Tidak ada yang bisa di-undo.") {
  echo "Redo action: " . $lastRedo['action'] . " at " . $lastRedo['time'] . "\n";
  $undoStack->push($lastRedo);
 } else {
  echo $lastRedo . "\n";
 }
}

// Informasi header
echo "=============================================\n\n";
echo "231232017 Andriana Rizki Barokah \n";
echo "=============================================\n\n";

// Tambahkan beberapa tindakan pengeditan gambar 
addEditAction($undoStack, ['action' => 'filter', 'time' => '2024-10-26 10:00:00']);
addEditAction($undoStack, ['action' => 'crop', 'time' => '2024-10-26 10:05:00']);
addEditAction($undoStack, ['action' => 'rotate', 'time' => '2024-10-26 10:10:00']);

// Lakukan undo dan redo 
undoAction($undoStack, $redoStack); // Undo rotate 
undoAction($undoStack, $redoStack); // Undo crop 
redoAction($redoStack, $undoStack); // Redo crop 
