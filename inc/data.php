<?php
/* Single source of truth for project content. Edit here, not in the pages. */

$PROJECTS = [
  [
    'slug' => 'greenlight',
    'name' => 'greenlight',
    'role' => 'On-call incident investigator that must prove it before it acts',
    'blurb' => 'An agent that diagnoses production incidents the way a good SRE does: reads the change history, forms hypotheses, and is blocked by a deterministic gate from concluding until it has verified the mechanism with an active probe. No remediation ever executes without a human approving it. Built end to end with Claude Code; the session transcripts ship in the repo.',
    'metrics' => [
      ['100%', 'root-cause accuracy'],
      ['+17pp', 'over baseline'],
      ['100%', 'probe-verified'],
      ['0', 'api calls to replay'],
    ],
    'tags' => ['Python', 'Agent tool-loop', 'Eval harness', 'pytest'],
    'repo' => 'https://github.com/SAI-HARISH2007/greenlight',
    'note' => 'micro1 Frontier Engineering Challenge 2026 · solo entry',
  ],
  [
    'slug' => 'activation-shield',
    'name' => 'activation-shield',
    'role' => 'Suppressing a trained deception at inference, without touching weights',
    'blurb' => 'I fine-tuned a conditionally deceptive GPT-2, extracted the deception direction from its residual-stream activations, then suppressed it at inference with a forward hook and no weight changes at all. Detection turns out to be near-perfect. Causal suppression is the hard part, and I measure it honestly as honesty restored against capability retained.',
    'metrics' => [
      ['GPT-2', 'model studied'],
      ['0', 'weights modified'],
    ],
    'tags' => ['PyTorch', 'Transformers', 'Interpretability'],
    'repo' => 'https://github.com/SAI-HARISH2007/activation-shield',
    'note' => 'Independent alignment research · in progress',
  ],
  [
    'slug' => 'safestep',
    'name' => 'SafeStep',
    'role' => 'A safety app, and the adversarial audit that found it wanting',
    'blurb' => 'An LLM scores how safe a walking route is from environmental signals, behind a Gemini to Groq fallback chain with server-side key handling and validated output. Then I attacked it. The eval harness I wrote against my own system found prompt injection succeeding 81% of the time through location names alone. I fixed input validation and published the rest as an open audit rather than sitting on it.',
    'metrics' => [
      ['1st', 'techsprint, gdg'],
      ['81%', 'injection found'],
      ['σ≈1.5', 'scoring drift'],
    ],
    'tags' => ['Next.js', 'TypeScript', 'Gemini / Groq', 'Firebase'],
    'repo' => 'https://github.com/SAI-HARISH2007/Safestep',
    'note' => '1st place, TechSprint (GDG On Campus, IFHE) · team of 3, team lead',
  ],
  [
    'slug' => 'quantbot',
    'name' => 'QuantBot',
    'role' => 'A trading engine whose kill switch the strategies cannot reach',
    'blurb' => 'An event-driven backtesting engine and paper-trading runner in which the same strategy code runs unchanged in both. Every strategy has to clear walk-forward validation with block-bootstrap confidence intervals before it is promoted. The risk layer sits on a control plane separate from strategy logic, so a strategy cannot override its own drawdown kill switch. Paper trading only, by design.',
    'metrics' => [
      ['5.5k', 'lines'],
      ['83', 'tests'],
      ['strict', 'mypy'],
    ],
    'tags' => ['Python', 'pandas / NumPy', 'FastAPI', 'WebSockets'],
    'repo' => 'https://github.com/SAI-HARISH2007/quantbot',
    'note' => 'Research-first · paper trading only',
  ],
  [
    'slug' => 'reclaim',
    'name' => 'Reclaim',
    'role' => 'Rules where correctness is knowable, a model only for the ambiguous tail',
    'blurb' => 'A failed-payment recovery agent. Razorpay documents 114 distinct failure reasons, and mapping one to a recovery category is a lookup, not a judgement call, so it lives in an auditable rule table that cannot hallucinate. Only genuinely ambiguous reasons reach a model. Retry caps, cool-downs and compliance stops are enforced in code rather than in prompts.',
    'metrics' => [
      ['114', 'failure reasons'],
      ['0', 'limits in prompts'],
    ],
    'tags' => ['Python', 'FastAPI', 'LLM triage', 'Razorpay'],
    'repo' => 'https://github.com/SAI-HARISH2007/buildathon-2026',
    'note' => 'Razorpay AI Buildathon 2026 · Track 03',
  ],
  [
    'slug' => 'sentinel',
    'name' => 'Sentinel',
    'role' => 'Energy-resilience command centre on a 3D globe',
    'blurb' => 'Real-time monitoring of geopolitical risk to energy supply: live news ingestion, supply-shock detection, impact cascades, and response recommendations that show their reasoning. Provider-agnostic behind an OpenAI-compatible interface, and it degrades to deterministic output if the model fails mid-demo.',
    'metrics' => [
      ['8', 'services modelled'],
      ['live', 'news ingestion'],
    ],
    'tags' => ['TypeScript', 'Next.js', 'Real-time pipelines'],
    'repo' => 'https://github.com/SAI-HARISH2007/sentinel',
    'note' => 'ET AI Hackathon 2026',
  ],
];
