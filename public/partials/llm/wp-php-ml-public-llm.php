<?php

use Phpml\Classification\NaiveBayes;
use Phpml\Dataset\ArrayDataset;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\StopWords\English;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Pipeline;

use Phpml\FeatureExtraction\TokenCountVectorizer;

// Tokenisasi
$tokenizer = new WordTokenizer();
$vectorizer = new TokenCountVectorizer($tokenizer);

// Data Training (contoh sederhana)
$samples = [
    'Saya suka belajar pemrograman',
    'Saya tidak suka matematika',
    'Pemrograman itu menyenangkan',
    'Matematika itu membosankan',
    'Belajar fisika itu sulit',
    'Bahasa Indonesia itu mudah',
    'Filosofi sangat menarik',
    'Sains itu menantang'
];
$samplesAsli = $samples;

$labels = [
    'positif', 'negatif', 'positif', 'negatif', 'negatif', 'positif', 'positif', 'negatif'
];

// Mengubah teks menjadi fitur
$vectorizer->fit($samples);
$vectorizer->transform($samples);

// Menerapkan Tf-Idf (meningkatkan fitur teks)
$tfIdfTransformer = new TfIdfTransformer($samples);
$tfIdfTransformer->transform($samples);

// Inisialisasi classifier (Naive Bayes)
$classifier = new NaiveBayes();
$classifier->train($samples, $labels);

// Prediksi untuk teks baru
$testSamples = [
    'Saya suka fisika',
    'Saya tidak suka belajar bahasa Indonesia'
];
$testSamplesAsli = $testSamples;

// Lakukan transformasi yang sama ke data uji
$vectorizer->transform($testSamples);
$tfIdfTransformer->transform($testSamples);

// Prediksi hasil
$predicted = $classifier->predict($testSamples);

echo '<h1 class="text-center">Data training</h1>';
echo '<ul>';
foreach ($samplesAsli as $index => $sample) {
    echo '<li>Teks: "' . $sample . '" = ' . $labels[$index] . "</li>";
}
echo '</ul>';

// Output hasil prediksi
echo '<h1 class="text-center">Hasil Prediksi</h1>';
echo '<ul>';
foreach ($testSamplesAsli as $index => $sample) {
    echo '<li>Teks: "' . $sample . '" diprediksi sebagai: ' . $predicted[$index] . "</li>";
}
echo '</ul>';
