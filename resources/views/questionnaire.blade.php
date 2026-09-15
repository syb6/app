@extends('layouts.app')

@section('styles')
<style>
    .step-card {
        display: none;
        animation: fadeInSlide 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .step-card.active {
        display: block;
    }
    @keyframes fadeInSlide {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background-color: var(--primary-pink);
        transition: width 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container my-auto py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            
            <div class="progress mb-3" style="height: 8px; border-radius: 10px; background-color: #FFE4E1;">
                <div id="progress-bar" class="progress-bar-custom" style="width: 8.33%;"></div>
            </div>

            <div class="cute-card p-3 p-sm-4 p-md-5">
                <form id="questionnaireForm">
                    @csrf
                    
                    <!-- Step 1 -->
                    <div class="step-card active" data-step="1">
                        <h3 class="fw-bold mb-3 text-center">What is your name? 💕</h3>
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-card" data-step="2">
                        <h3 class="fw-bold mb-3 text-center">Where do you live? 📍</h3>
                        <div class="mb-3">
                            <input type="text" name="location" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-card" data-step="3">
                        <h3 class="fw-bold mb-3 text-center">When is your birthday? 🎂</h3>
                        <div class="mb-3">
                            <input type="date" name="birthday" class="form-control form-control-lg" required>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="step-card" data-step="4">
                        <h3 class="fw-bold mb-3 text-center">What is your favorite color? 🎨</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_color" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="step-card" data-step="5">
                        <h3 class="fw-bold mb-3 text-center">Favorite food of all time? 🍝</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_food" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="step-card" data-step="6">
                        <h3 class="fw-bold mb-3 text-center">Favorite movie or TV show? 🍿</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_movie" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 7 -->
                    <div class="step-card" data-step="7">
                        <h3 class="fw-bold mb-3 text-center">Favorite song or artist? 🎵</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_song" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 8 -->
                    <div class="step-card" data-step="8">
                        <h3 class="fw-bold mb-3 text-center">Your favorite memory together? ✨</h3>
                        <div class="mb-3">
                            <textarea name="favorite_memory" class="form-control" rows="4" placeholder="Tell me about it..." required></textarea>
                        </div>
                    </div>

                    <!-- Step 9 -->
                    <div class="step-card" data-step="9">
                        <h3 class="fw-bold mb-3 text-center">Favorite place to visit? 🌸</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_place" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 10 -->
                    <div class="step-card" data-step="10">
                        <h3 class="fw-bold mb-3 text-center">Favorite snack or sweet treat? 🍩</h3>
                        <div class="mb-3">
                            <input type="text" name="favorite_snack" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 11 -->
                    <div class="step-card" data-step="11">
                        <h3 class="fw-bold mb-3 text-center">Dream travel destination? ✈️</h3>
                        <div class="mb-3">
                            <input type="text" name="dream_destination" class="form-control form-control-lg" placeholder="Type your answer..." required>
                        </div>
                    </div>

                    <!-- Step 12 -->
                    <div class="step-card" data-step="12">
                        <h3 class="fw-bold mb-3 text-center">Anything else on your mind? 💭</h3>
                        <div class="mb-3">
                            <textarea name="anything_else" class="form-control" rows="4" placeholder="Any final thoughts or notes (optional)..."></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-3 px-sm-4" id="prevBtn" style="display: none; min-height: 44px;">Previous</button>
                        <button type="button" class="btn btn-pink ms-auto" id="nextBtn">Next step <i class="fa-solid fa-arrow-right ms-1"></i></button>
                        <button type="submit" class="btn btn-pink ms-auto" id="submitBtn" style="display: none;">Submit ✨</button>
                    </div>
                </form>

                <!-- Thank You Card -->
                <div id="thankYouCard" class="text-center py-3" style="display: none;">
                    <div class="mb-3">
                        <i class="fa-solid fa-heart-circle-check text-danger display-2"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Thank You! 💖</h2>
                    <p class="text-muted">Your answers have been saved successfully!</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentStep = 1;
        const totalSteps = 12;
        
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const progressBar = document.getElementById('progress-bar');
        const form = document.getElementById('questionnaireForm');
        const thankYouCard = document.getElementById('thankYouCard');

        function updateStep(step) {
            document.querySelectorAll('.step-card').forEach(card => card.classList.remove('active'));
            document.querySelector(`.step-card[data-step="${step}"]`).classList.add('active');

            prevBtn.style.display = step === 1 ? 'none' : 'inline-flex';
            if (step === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-flex';
            } else {
                nextBtn.style.display = 'inline-flex';
                submitBtn.style.display = 'none';
            }

            const percentage = (step / totalSteps) * 100;
            progressBar.style.width = `${percentage}%`;
        }

        function validateCurrentStep() {
            const currentCard = document.querySelector(`.step-card[data-step="${currentStep}"]`);
            const inputs = currentCard.querySelectorAll('input, textarea');
            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }
            return true;
        }

        nextBtn.addEventListener('click', function () {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStep(currentStep);
                }
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                updateStep(currentStep);
            }
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!validateCurrentStep()) return;

            const formData = new FormData(form);

            fetch('{{ route("questionnaire.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.style.display = 'none';
                    progressBar.parentElement.style.display = 'none';
                    thankYouCard.style.display = 'block';

                    confetti({
                        particleCount: 100,
                        spread: 60,
                        origin: { y: 0.6 },
                        colors: ['#FFB6C1', '#FF69B4', '#D4AF37']
                    });
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                alert('Something went wrong. Please try submitting again.');
            });
        });
    });
</script>
@endsection