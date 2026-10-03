/* Single source of truth for project content.
   Every number here is measured in the linked repo. Do not round up. */

export const PROJECTS = [
  {
    slug: 'greenlight',
    name: 'greenlight',
    role: 'On-call incident investigator that must prove it before it acts',
    blurb:
      'An agent that diagnoses production incidents the way a good SRE does: reads the change history, forms hypotheses, and is blocked by a deterministic gate from concluding until it has verified the mechanism with an active probe. No remediation runs without a human approving it. Built end to end with Claude Code; the session transcripts ship in the repo.',
    metrics: [
      ['83→100%', 'root-cause accuracy, 12 seeded incidents'],
      ['0→100%', 'verdicts verified by a live probe'],
      ['0', 'API calls to reproduce every number'],
    ],
    tags: ['Python', 'Agent tool-loop', 'Eval harness', 'pytest'],
    repo: 'https://github.com/SAI-HARISH2007/greenlight',
    note: 'micro1 Frontier Engineering Challenge 2026 · solo entry',
    diagram: 'gate',
  },
  {
    slug: 'activation-shield',
    name: 'activation-shield',
    role: 'Suppressing a trained deception at inference, without touching weights',
    blurb:
      'I fine-tuned a conditionally deceptive GPT-2, extracted the deception direction from its residual-stream activations, then suppressed it at inference with a forward hook and no weight changes at all. Detection turns out to be near-perfect. Causal suppression is the hard part, and I measure it honestly as honesty restored against capability retained.',
    metrics: [
      ['GPT-2', 'model studied'],
      ['0', 'weights modified'],
      ['wk 1+', 'independent research, ongoing'],
    ],
    tags: ['PyTorch', 'Transformers', 'Interpretability'],
    repo: 'https://github.com/SAI-HARISH2007/activation-shield',
    note: 'Independent alignment research · in progress since Aug 2026',
    diagram: 'residual',
  },
  {
    slug: 'safestep',
    name: 'SafeStep',
    role: 'A safety app, and the adversarial audit that found it wanting',
    blurb:
      'An LLM scores how safe a walking route is from environmental signals, behind a Gemini-to-Groq fallback chain with server-side key handling and validated output. Then I attacked it. The eval harness I wrote against my own system found prompt injection succeeding 81% of the time through location names alone. I fixed input validation and published the rest as an open audit rather than sitting on it.',
    metrics: [
      ['1st', 'TechSprint, GDG On Campus IFHE'],
      ['81%', 'injection success found by my own audit'],
      ['σ≈1.5', 'score drift on identical routes'],
    ],
    tags: ['Next.js', 'TypeScript', 'Gemini / Groq', 'Firebase'],
    repo: 'https://github.com/SAI-HARISH2007/Safestep',
    note: 'Team of 3, team lead · wrote most of the code',
    diagram: 'audit',
  },
  {
    slug: 'quantbot',
    name: 'QuantBot',
    role: 'A trading engine whose kill switch the strategies cannot reach',
    blurb:
      'An event-driven backtesting engine and paper-trading runner in which the same strategy code runs unchanged in both. Every strategy has to clear walk-forward validation with block-bootstrap confidence intervals before it is promoted. The risk layer sits on a control plane separate from strategy logic, so a strategy cannot override its own drawdown kill switch. Paper trading only, by design.',
    metrics: [
      ['5.5k', 'lines'],
      ['83', 'unit tests'],
      ['strict', 'mypy'],
    ],
    tags: ['Python', 'pandas / NumPy', 'FastAPI', 'WebSockets'],
    repo: 'https://github.com/SAI-HARISH2007/quantbot',
    note: 'Research-first · paper trading only, never live',
    diagram: 'planes',
  },
  {
    slug: 'reclaim',
    name: 'Reclaim',
    role: 'Rules where correctness is knowable, a model only for the ambiguous tail',
    blurb:
      'A failed-payment recovery agent. Razorpay documents 114 distinct failure reasons, and mapping one to a recovery category is a lookup, not a judgement call, so it lives in an auditable rule table that cannot hallucinate. Only genuinely ambiguous reasons reach a model. Retry caps, cool-downs and compliance stops are enforced in code rather than in prompts.',
    metrics: [
      ['114', 'failure reasons in the rule table'],
      ['2', 'ambiguous reasons that reach a model'],
      ['0', 'safety limits that live in prompts'],
    ],
    tags: ['Python', 'FastAPI', 'LLM triage', 'Razorpay'],
    repo: 'https://github.com/SAI-HARISH2007/buildathon-2026',
    note: 'Razorpay AI Buildathon 2026 · Track 03',
    diagram: 'table',
  },
  {
    slug: 'sentinel',
    name: 'Sentinel',
    role: 'Energy-resilience command centre on a 3D globe',
    blurb:
      'Real-time monitoring of geopolitical risk to energy supply: live news ingestion, supply-shock detection, impact cascades, and response recommendations that show their reasoning. Provider-agnostic behind an OpenAI-compatible interface, and it degrades to deterministic output if the model fails mid-demo.',
    metrics: [
      ['live', 'news ingestion'],
      ['3', 'interchangeable model providers'],
    ],
    tags: ['TypeScript', 'Next.js', 'Real-time pipelines'],
    repo: 'https://github.com/SAI-HARISH2007/sentinel',
    note: 'ET AI Hackathon 2026',
    diagram: 'globe',
  },
];

/* Snapshot of open-source PRs, used only when api.github.com is unreachable.
   Verified 2026-09-04. */
export const PR_SNAPSHOT = {
  asOf: '2026-09-04',
  items: [
    { repo: 'AOSSIE-Org/EduAid', number: 672, title: '[Backend] Add lightweight request tracing for upload and transcription', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/672' },
    { repo: 'AOSSIE-Org/EduAid', number: 667, title: '[Backend] Add content-based file validation (magic number checks)', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/667' },
    { repo: 'AOSSIE-Org/EduAid', number: 665, title: '[Backend] Add file upload validation and size limits', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/665' },
    { repo: 'AOSSIE-Org/EduAid', number: 664, title: '[Backend] Ensure subtitle file cleanup on failure', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/664' },
    { repo: 'AOSSIE-Org/EduAid', number: 660, title: '[Security] Fix directory traversal vulnerability in file upload', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/660' },
    { repo: 'AOSSIE-Org/EduAid', number: 472, title: 'Improve fallback key selection logic for MCQ generation', state: 'open', url: 'https://github.com/AOSSIE-Org/EduAid/pull/472' },
    { repo: 'AOSSIE-Org/EduAid', number: 671, title: '[Backend] Add lightweight request tracing (earlier attempt)', state: 'closed', url: 'https://github.com/AOSSIE-Org/EduAid/pull/671' },
    { repo: 'matplotlib/matplotlib', number: 31150, title: 'FIX: ensure text outside axes is captured in constrained_layout', state: 'closed', url: 'https://github.com/matplotlib/matplotlib/pull/31150' },
  ],
};

export const WRITING = [
  {
    title: 'Beyond the Hype: What AI Really Means for CSE Students Today',
    line: 'AI transforms careers rather than eliminating them; the students who keep building will be fine.',
    url: 'https://acadnews.com/beyond-the-hype-what-ai-really-means-for-cse-students-today/',
  },
  {
    title: 'How to Build Better Study Habits: A Guide for College Students',
    line: 'Systems over motivation, written for people who are out of the house twelve hours a day.',
    url: 'https://acadnews.com/how-to-build-better-study-habits-a-guide-for-college-students/',
  },
  {
    title: 'Mixing vs Mastering: What’s the Real Difference',
    line: 'The music-production side. Two jobs that get confused because they share a room.',
    url: 'https://acadnews.com/mixing-vs-mastering-whats-the-real-difference/',
  },
];

/* Everything else that is public on GitHub and is my own work (forks live in the
   open-source panel). One line each, written from the repo's own README or code.
   Where a repo has no README, the line says only what the files show. */
export const ARCHIVE = [
  {
    name: 'Provenance',
    repo: 'https://github.com/SAI-HARISH2007/provenance_hwh',
    year: '2026',
    line: 'An on-call agent whose memory has to prove itself: a remembered fix is a claim, and a probe in the current incident must confirm it before it runs. Built over a weekend on top of greenlight for Hack With Hyderabad 3.0. 16 scripted incidents, 51 offline tests.',
    tags: ['Python', 'Agent memory', 'Hackathon'],
  },
  {
    name: 'Sentinel SQL',
    repo: 'https://github.com/SAI-HARISH2007/sentinel-sql',
    year: '2026',
    line: 'Fraud detection that lives inside MySQL: a trigger calls a stored procedure that scores each transaction against the user’s own history. 12,000+ seeded transactions. DBMS course project, team of two.',
    tags: ['MySQL 8', 'Triggers', 'Stored procedures'],
  },
  {
    name: 'Plately',
    repo: 'https://github.com/SAI-HARISH2007/Plately',
    year: '2026',
    line: 'AI-assisted mess management for a university: live demand data between students and kitchen staff, aimed at cutting food waste. Deployed.',
    tags: ['TypeScript', 'Gemini', 'Vercel'],
  },
  {
    name: 'InterviewX',
    repo: 'https://github.com/SAI-HARISH2007/interviewX',
    year: '2025',
    line: 'Spoken interview practice with rubric-scored LLM feedback. Every result is badged LLM or offline fallback, and the README lists exactly which features are not AI.',
    tags: ['JavaScript', 'Node', 'Groq'],
  },
  {
    name: 'BitTalk',
    repo: 'https://github.com/SAI-HARISH2007/BitTalk',
    year: '2025',
    line: 'Classroom chat on raw Python sockets: thread-per-client server with lock-guarded shared state, a moderation console, and a desktop client. No frameworks.',
    tags: ['Python', 'Sockets', 'Threading'],
  },
  {
    name: 'Cognify',
    repo: 'https://github.com/SAI-HARISH2007/Cognify',
    year: '2025',
    line: 'A health companion that pairs physical monitoring with mental-wellness support, using the Gemini API. Early work; no README.',
    tags: ['JavaScript', 'Gemini'],
  },
  {
    name: 'AlgoViz 3.0',
    repo: 'https://github.com/SAI-HARISH2007/AlgoViz_3.0',
    year: '2026',
    line: 'Browser algorithm visualisers, with scroll-driven image sequences. No README; the code is under visualizers/ and algorithms/.',
    tags: ['JavaScript'],
  },
  {
    name: 'House price prediction',
    repo: 'https://github.com/SAI-HARISH2007/house_price_prediction',
    year: '2025',
    line: 'A model trained on Hyderabad listings, with a small app around it. First ML project; no evaluation write-up.',
    tags: ['Python', 'scikit-learn'],
  },
  {
    name: 'Wikipedia scraper',
    repo: 'https://github.com/SAI-HARISH2007/web-scraper-12',
    year: '2025',
    line: 'Class 12 project: desktop Wikipedia summariser with a login system, themes, text-to-speech, history and daily search stats.',
    tags: ['Python', 'CustomTkinter'],
  },
  {
    name: 'freshtrack',
    repo: 'https://github.com/SAI-HARISH2007/freshtrack',
    year: '2025',
    line: 'A small C program that tracks inventory from a text file.',
    tags: ['C'],
  },
  {
    name: 'NeetCode submissions',
    repo: 'https://github.com/SAI-HARISH2007/neetcode-submissions',
    year: '2026',
    line: 'Interview-practice solutions, synced from NeetCode. The DSA work that is still in progress.',
    tags: ['Python'],
  },
];

/* Scaffolds and scratch repos. Honest label: little original code. */
export const SCRATCH = [
  ['Mood_Dial', 'https://github.com/SAI-HARISH2007/Mood_Dial'],
  ['Yap', 'https://github.com/SAI-HARISH2007/Yap'],
  ['EduBuddy', 'https://github.com/SAI-HARISH2007/EduBuddy'],
  ['lovelens', 'https://github.com/SAI-HARISH2007/lovelens'],
  ['QuoteGita', 'https://github.com/SAI-HARISH2007/QuoteGita'],
];
