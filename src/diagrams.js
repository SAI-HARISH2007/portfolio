/* Mechanism diagrams, one per project. Drawn in a single stroke weight; the
   accent marks the one part of each system that does the guaranteeing. */

const arrow = (x1, y1, x2, y2, cls = 'stroke') =>
  `<path class="${cls}" d="M${x1} ${y1}L${x2} ${y2}"/><path class="${cls}" d="M${x2 - 5} ${y2 - 3.5}L${x2} ${y2}L${x2 - 5} ${y2 + 3.5}"/>`;

const box = (x, y, w, h, label, cls = '') =>
  `<rect class="paper stroke ${cls}" x="${x}" y="${y}" width="${w}" height="${h}" rx="4"/>
   <text class="lbl" x="${x + w / 2}" y="${y + h / 2 + 3.5}" text-anchor="middle">${label}</text>`;

export const DIAGRAMS = {
  /* greenlight: the investigator loop cannot conclude without the gate. */
  gate: `<svg viewBox="0 0 320 200" role="img" aria-label="Incident flows into an investigator loop, then a verification gate that demands a live probe, then a reviewer and a human checkpoint before remediation">
    ${box(8, 84, 56, 32, 'incident')}
    ${arrow(64, 100, 86, 100)}
    <circle class="paper stroke" cx="118" cy="100" r="28"/>
    <path class="stroke" d="M104 92a16 16 0 1 1 3 20" /><path class="stroke" d="M104 105l3 7 7-3"/>
    <text x="118" y="141" text-anchor="middle">tool loop</text>
    ${arrow(146, 100, 168, 100)}
    <path class="paper stroke key" d="M196 72l28 28-28 28-28-28z"/>
    <text class="lbl" x="196" y="103.5" text-anchor="middle">gate</text>
    <text x="196" y="141" text-anchor="middle">probe verified?</text>
    <path class="stroke key" d="M196 72V44H118v28"/><path class="stroke key" d="M114 66l4 6 4-6"/>
    <text x="157" y="40" text-anchor="middle">no → back to evidence</text>
    ${arrow(224, 100, 246, 100, 'stroke key')}
    ${box(246, 84, 66, 32, 'reviewer')}
    <path class="stroke" d="M279 116v50H150"/>
    ${box(96, 152, 54, 28, 'human ✓')}
    ${arrow(96, 166, 74, 166)}
    ${box(8, 152, 66, 28, 'remediate')}
  </svg>`,

  /* activation-shield: a hook subtracts the deception direction at one layer. */
  residual: `<svg viewBox="0 0 320 200" role="img" aria-label="Residual stream across transformer layers; at one layer a forward hook subtracts the projection onto the deception direction, leaving weights untouched">
    <path class="soft" d="M16 60h288M16 100h288M16 140h288"/>
    ${[0,1,2,3,4,5,6,7,8,9,10,11].map(i => `<rect class="paper stroke" x="${20 + i * 24}" y="70" width="16" height="60" rx="3"/>`).join('')}
    <text x="28" y="152">L0</text><text x="278" y="152">L11</text>
    <text x="160" y="52" text-anchor="middle">residual stream h</text>
    <rect class="key" x="160" y="64" width="24" height="72" rx="4" fill="none" stroke-dasharray="3 3"/>
    <path class="stroke key" d="M172 64V24"/><path class="stroke key" d="M168 30l4-6 4 6"/>
    <text x="172" y="18" text-anchor="middle">forward hook</text>
    <text class="lbl" x="160" y="176" text-anchor="middle">h ← h − (h · d̂) d̂</text>
    <text x="160" y="190" text-anchor="middle">0 weights modified</text>
    ${arrow(238, 100, 300, 100)}
  </svg>`,

  /* SafeStep: the scorer, the fallback chain, and the audit that attacked it. */
  audit: `<svg viewBox="0 0 320 200" role="img" aria-label="Route signals enter an LLM scorer with a Gemini to Groq fallback chain; an adversarial harness attacks the same path through location names">
    <path class="stroke" d="M14 150C60 120 80 170 120 130s70-40 110-30"/>
    <circle class="ink" cx="14" cy="150" r="3"/><circle class="ink" cx="230" cy="100" r="3"/>
    <text x="18" y="168">route</text>
    ${box(96, 20, 128, 34, 'LLM route scorer')}
    <path class="stroke" d="M120 130V54"/>
    ${box(236, 14, 70, 22, 'Gemini')}
    ${box(236, 44, 70, 22, 'Groq')}
    <path class="stroke" d="M224 37h12"/><path class="stroke" d="M271 36v8"/>
    <text x="271" y="80" text-anchor="middle">fallback</text>
    <path class="stroke key" d="M40 64h48"/><path class="stroke key" d="M83 60l5 4-5 4"/>
    ${box(8, 52, 32, 24, 'attack', 'key')}
    <text x="24" y="92">place</text><text x="24" y="103">names</text>
    <rect class="paper stroke key" x="164" y="146" width="146" height="44" rx="4"/>
    <text class="lbl" x="237" y="164" text-anchor="middle">81% injection success</text>
    <text x="237" y="180" text-anchor="middle">found by my own harness</text>
  </svg>`,

  /* QuantBot: strategies run on one plane; the kill switch lives on another. */
  planes: `<svg viewBox="0 0 320 200" role="img" aria-label="Strategy plane with backtest and paper runners sharing one strategy; a separate control plane holds risk limits and the kill switch the strategy cannot reach">
    <rect class="paper soft" x="12" y="18" width="296" height="76" rx="6"/>
    <text x="20" y="32">strategy plane</text>
    ${box(24, 48, 84, 30, 'backtest')}
    ${box(212, 48, 84, 30, 'paper')}
    ${box(118, 48, 84, 30, 'strategy')}
    <path class="stroke" d="M108 63h10M202 63h10"/>
    <path class="stroke key" d="M12 112h296" stroke-dasharray="6 4"/>
    <text class="lbl" x="160" y="108" text-anchor="middle">no calls cross this line downward</text>
    <rect class="paper soft" x="12" y="122" width="296" height="66" rx="6"/>
    <text x="20" y="136">control plane</text>
    ${box(24, 146, 84, 30, 'exposure')}
    ${box(118, 146, 84, 30, 'kelly size')}
    ${box(212, 146, 84, 30, 'kill switch', 'key')}
    <path class="stroke key" d="M254 146V94"/><path class="stroke key" d="M250 100l4-6 4 6"/>
  </svg>`,

  /* Reclaim: a rule table for the knowable, a model for the two ambiguous rows. */
  table: `<svg viewBox="0 0 320 200" role="img" aria-label="A table of 114 failure reasons maps each to a recovery play; only two ambiguous reasons route to a model, and the limits live in code">
    ${[0,1,2,3,4,5,6,7].map(i => `<rect class="paper stroke" x="14" y="${16 + i * 18}" width="150" height="14" rx="2"/>
      <rect class="ink" x="20" y="${21 + i * 18}" width="${34 + (i * 29) % 40}" height="4" rx="2" opacity=".55"/>
      <rect class="ink" x="112" y="${21 + i * 18}" width="40" height="4" rx="2" opacity=".2"/>`).join('')}
    <text x="14" y="176">114 reasons → play</text>
    ${arrow(164, 88, 198, 88)}
    ${box(198, 70, 108, 36, 'recovery play')}
    <rect class="key" x="12" y="122" width="154" height="34" rx="3" fill="none"/>
    <text class="lbl" x="88" y="142" text-anchor="middle">2 ambiguous reasons</text>
    ${arrow(166, 139, 198, 139, 'stroke key')}
    ${box(198, 122, 108, 34, 'model, 2 rows', 'key')}
    <text x="252" y="176" text-anchor="middle">limits live in code</text>
  </svg>`,

  /* Sentinel: feeds into a globe, out to a cascade. */
  globe: `<svg viewBox="0 0 320 200" role="img" aria-label="News feeds enter a globe model; supply shocks propagate as an impact cascade with a deterministic fallback if the model fails">
    <circle class="paper stroke" cx="150" cy="100" r="62"/>
    <ellipse class="soft" cx="150" cy="100" rx="24" ry="62"/>
    <ellipse class="soft" cx="150" cy="100" rx="48" ry="62"/>
    <path class="soft" d="M88 100h124M97 70h106M97 130h106"/>
    ${[[130,78],[175,92],[142,118],[168,126]].map(([x,y]) => `<circle class="keyfill" cx="${x}" cy="${y}" r="3"/>`).join('')}
    <path class="stroke key" d="M130 78l45 14-33 26 26 8"/>
    <text x="24" y="40">news feeds</text>
    ${arrow(24, 48, 92, 76)}
    ${arrow(24, 152, 92, 124)}
    <text x="24" y="170">prices, flows</text>
    ${arrow(212, 100, 250, 100, 'stroke key')}
    ${box(250, 84, 60, 32, 'cascade', 'key')}
    <text x="280" y="140" text-anchor="middle">deterministic</text>
    <text x="280" y="152" text-anchor="middle">fallback if the</text>
    <text x="280" y="164" text-anchor="middle">model fails</text>
  </svg>`,
};
