enum Type {
    MAJOR = "major",
    MINOR = "minor",
    PATCH = "patch",
}

const encoder = new TextEncoder();
const decoder = new TextDecoder();

const type: Type = Type[(Deno.args[0] || "patch").toUpperCase() as keyof typeof Type] || Type.PATCH;

const latestTag: string = decoder.decode(await Deno.run({
    cmd: ["git", "rev-list", "--tags", "--max-count=1"],
    stdout: "piped",
}).output()).trim();

const version: string = decoder.decode(await Deno.run({
    cmd: ['git', 'describe', '--tags', `${latestTag}`],
    stdout: 'piped'
}).output()).trim();

let [major, minor, patch] = version.split('.').map(v => parseInt(v));

switch (type) {
    case Type.MAJOR:
        major++;
        minor = 0;
        patch = 0;
        break;
    case Type.MINOR:
        minor++;
        patch = 0;
        break;
    case Type.PATCH:
        patch++;
        break;
}

const newVersion = `${major}.${minor}.${patch}`;

const files = [{
    path: "constants.php",
    regex: /(?<=const TRANSPOSH_PLUGIN_VER = ')([\d\.]+)(?=';)/,
}, {
    path: "open-transposh.php",
    regex: /(?<=Version:\s+)([\d\.]+)(?=\n)/,
}, {
    path: "readme.txt",
    regex: /(?<=Stable tag:\s+)([\d\.]+)(?=\n)/,
}];

for await (const file of files) {
    const data = decoder.decode(await Deno.readFile(file.path));
    const newData = data.replace(file.regex, newVersion);
    await Deno.writeFile(file.path, encoder.encode(newData));
}
